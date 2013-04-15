<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Database Class for the Core Framework.
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 12:56 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class Database
{
    private $connectlink; //Database Connection Link
    private $resultlink; //Database Result Recordset link
    private $rows; //Stores the rows for the resultset
    private $pre = ""; //table prefix
    private $linkId = 0;
    private $connectError = "Could not connect to Database Server.";
    private $databaseError = "Could not select the specified Database.";
    private $queryError = "Problem with executing the Database Query.";
    private $fetchError = "Problem with fetching data.";
    private $numError = "Problem with fetching number of rows.";

    /**
     * @purpose: This is the Constrcutor for the Database Class. This opens a connection with the Database Server.
     * @author: Saurabh Sinha
     * @param $hostname
     * @param $username
     * @param $password
     * @param $database
     */
    public function __construct($hostname, $username, $password, $database)
    {
        $this->connectlink = @mysql_connect($hostname, $username, $password) or die($this->connectError);
        if (!($this->connectlink)) {

        } else {
            @mysql_select_db($database) or die($this->databaseError);
        }
    }

    /**
     * @purpose: This is the Descturctor for the Class. This closes the Connection With the Database Server.
     * @author: Saurabh Sinha
     */
    public function __destruct()
    {
        @mysql_close($this->connectlink);
    }

    /**
     * @purpose: This function is responsible to execute the Query.
     * @author: Saurabh Sinha
     *
     * @param $sql
     * @param bool $queryDump
     *
     * @return resource
     */
    public function query($sql, $queryDump = FALSE)
    {
        if ($queryDump) {
            return $sql;
        }
        $this->resultlink = mysql_query($sql) or die(mysql_error());

        return $this->resultlink;
    }

    /**
     * @purpose: This function fetch the resultset in associative array.
     * @author: Saurabh Sinha
     *
     * @param $sql
     * @param bool $queryDump
     *
     * @return array|null
     */
    public function fetch_rows($sql, $queryDump = FALSE)
    {
        if ($queryDump) {
            return $sql;
        }
        $result = $this->query($sql);
        $rows = array();
        if ($result) {
            while ($row = @mysql_fetch_array($result)) {
                $rows[] = $row;
            }
        } else {
            $rows = NULL;
        }

        return $rows;
    }

    /**
     * @purpose: This function count the number of rows returned from the query.
     * @author: Saurabh Sinha
     *
     * @param $sql
     * @param bool $queryDump
     *
     * @return int
     */
    public function num_rows($sql, $queryDump = FALSE)
    {
        if ($queryDump) {
            return $sql;
        }

        $result = $this->query($sql);
        $totalRows = @mysql_num_rows($result);

        return $totalRows;
    }

    /**
     * @purpose: This function is responsible to insert rows into the table specified.
     * @author: Saurabh Sinha
     *
     * @param $table
     * @param $data
     * @param bool $queryDump
     *
     * @return bool|int|string
     */
    public function query_insert($table, $data, $queryDump = FALSE)
    {
        $q = "INSERT INTO `" . $this->pre . $table . "` ";
        $v = '';
        $n = '';
        foreach ($data as $key => $val) {
            $n .= "`$key`, ";
            if (strtolower($val) == 'null') {
                $v .= "NULL, ";
            } elseif (strtolower($val) == 'now()') {
                $v .= "NOW(), ";
            } else {
                $v .= "'" . $this->escape($val) . "', ";
            }
        }
        $q .= "(" . rtrim($n, ', ') . ") VALUES (" . rtrim($v, ', ') . ");";

        if ($queryDump) {
            return $q;
        }

        if ($this->query($q)) {
            //$this->free_result();
            return mysql_insert_id($this->connectlink);
        } else {
            return FALSE;
        }
    }

    public function multiple_insert($tableName, $dataArray, $queryDump = FALSE)
    {
        if ($tableName && is_array($dataArray)) {
            $query = "INSERT INTO $tableName ";
            $rows = implode(",", $dataArray['rows']);
            $rowsData = "(" . $rows . ")";
            $finalDataSet = implode(",", $dataArray['data']);
            $query = $query . $rowsData . "VALUES " . $finalDataSet;
            return $this->query($query);
        } else {
            return FALSE;
        }
    }

    /**
     * @purpose: This function is responsible for the escaping the slashes in the value.
     * @author: Saurabh Sinha
     *
     * @param $string
     *
     * @return string
     */
    public function escape($string)
    {
        if (get_magic_quotes_runtime()) {
            $string = stripslashes($string);
        }

        return @mysql_real_escape_string($string, $this->connectlink);
    }

    /**
     * @purpose: This function paginates the result set.
     * @author: Saurabh Sinha
     * @param $query
     * @param int $start
     * @param int $limit
     * @return array
     */
    public function paginateQuery($query, $start = 0, $limit = RECORDS_PER_PAGE)
    {
        $paginateArray = array();
        $paginateArray['total_rows'] = $this->num_rows($query);
        $paginateArray['total_pages'] = ceil($paginateArray['total_rows'] / $limit);
        if ($paginateArray['total_rows'] > 0) {
            $query .= " LIMIT $start, $limit";
            $paginateArray['result_set'] = $this->fetch_rows($query);
        }
        return $paginateArray;
    }
}
