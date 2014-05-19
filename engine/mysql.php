<?php
class Mysql
  {
    protected $_connect = false;
    protected $_aacQueries = 0;
    protected $_accQueriesData = array();

    /**
     * Initialize the mysql connection
     *
     * @param  array $mysql
     * @access public
     * @return void
    **/
    public function __construct($mysql) {
      $this->_connect = new mysqli($mysql['hostname'], $mysql['username'], $mysql['password'], $mysql['database']);
      if ($this->_connect->connect_errno) {
          die("Failed to connect to MySQL: (" . $this->_connect->connect_errno . ") " . $this->_connect->connect_error . $install);
      }
    }


    /**
     * Returns a string containing mysql schema for this server.
     *
     * @access public
     * @return string
    **/
    public function install() {
      $install = "<h2>Install:</h2>
                  <ol>
                    <li>
                      Import the below schema to database:<br>
                      <textarea cols=\"65\" rows=\"10\">

CREATE TABLE IF NOT EXISTS `znote` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `version` varchar(30) NOT NULL COMMENT 'Znote AAC version',
  `installed` int(10) NOT NULL,
  `cached` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `znote` (`version`, `installed`) VALUES
('$version', '$time');

                      </textarea>
                      </li>
                      <li>
                        <p>
                          Edit engine/config.php with correct mysql connection details.
                        </p>
                      </li>
                    </ol>";
      return $install;
    }


    /**
     * Select single row from database
     *
     * @param  string $query
     * @access public
     * @return mixed
    **/
    public function select_single($query) {
      $this->_aacQueries++;
      $this->accQueriesData[] = $query;

      $result = mysqli_query($this->_connect,$query) or die(var_dump($query)."<br>(query - <font color='red'>SQL error</font>) <br>Type: <b>select_single</b> (select single row from database)<br><br>".mysqli_error($this->_connect));
      $row = mysqli_fetch_assoc($result);
      return !empty($row) ? $row : false;
    }

    /**
     * Select multiple rows from database
     *
     * @param  string $query
     * @access public
     * @return mixed
    **/
    public function select_multi($query) {
      $this->_aacQueries++;
      $this->_accQueriesData[] = $query;

      $array = array();
      $results = mysqli_query($this->_connect,$query) or die(var_dump($query)."<br>(query - <font color='red'>SQL error</font>) <br>Type: <b>select_multi</b> (select multiple rows from database)<br><br>".mysqli_error($this->_connect));
      while($row = mysqli_fetch_assoc($results)) {
          $array[] = $row;
      }
      return !empty($array) ? $array : false;
    }

    /**
     * Update, insert or delete with no expected results
     *
     * @param  string $query
     * @access public
     * @return void
    **/
    public function update($query) {
      $this->voidQuery($query);
    }
    /**
     * Update, insert or delete with no expected results
     *
     * @param  string $query
     * @access public
     * @return void
    **/
    public function insert($query) {
      $this->voidQuery($query);
    }
    /**
     * Update, insert or delete with no expected results
     *
     * @param  string $query
     * @access public
     * @return void
    **/
    public function delete($query) {
      $this->voidQuery($query);
    }
    /**
     * Update, insert or delete with no expected results
     *
     * @param  string $query
     * @access public
     * @return void
    **/
    public function voidQuery($query) {
      $this->_aacQueries++;
      $this->_accQueriesData[] = $query;

      mysqli_query($this->_connect,$query) or die(var_dump($query)."<br>(query - <font color='red'>SQL error</font>) <br>Type: <b>voidQuery</b> (voidQuery is used for update, insert or delete from database)<br><br>".mysqli_error($this->_connect));
    }
    /**
     * Update, insert or delete with no expected results
     *
     * @param  string $escapestr
     * @access public
     * @return string
    **/
    public function escape($escapestr) {
      return mysqli_real_escape_string($this->_connect, $escapestr);
    }
  }
?>