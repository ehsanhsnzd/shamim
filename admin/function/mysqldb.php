<?


function sql_input ($input) {

  //$input=preg_replace('/union/i', '_union_', $input);
  $input=preg_replace('/load_file/i', '', $input);
  $input=preg_replace('/outfile/i', '', $input);
  $input=preg_replace('/--/i', '-', $input);
  $input=preg_replace('/BENCHMARK/i', '', $input);
  $input=preg_replace('/0x/i', '_0x_', $input);
  $input=preg_replace('/#/i', '_resh_', $input);
  $input=preg_replace('/CONCAT/i', '_concat_', $input);
  $input=preg_replace('/cmd/i', '_cmd_', $input);
  $input=preg_replace('/exec/i', '_exec_', $input);

  return $input;
}


function sql_out ($input) {

  $input=preg_replace('/_qt_/i', "'", $input);
  //$input=preg_replace('/_union_/i', 'union', $input);
  $input=preg_replace('/_0x_/i', '0x', $input);
  $input=preg_replace('/_char_/i', 'char', $input);
  $input=preg_replace('/_delete_/i', 'delete', $input);
  $input=preg_replace('/_drop_/i', 'drop', $input);
  $input=preg_replace('/_update_/i', 'update', $input);
  $input=preg_replace('/_insert_/i', 'insert', $input);
  $input=preg_replace('/_alter_/i', 'alter', $input);
  $input=preg_replace('/_select_/i', 'select', $input);
  $input=preg_replace('/_resh_/i', '#', $input);
  $input=preg_replace('/_concat_/i', 'concat', $input);
  $input=preg_replace('/_cmd_/i', 'cmd', $input);
  $input=preg_replace('/_exec_/i', 'exec', $input);

  return $input;
}

class TMySQLConnection
{

  var $connection;

  var $host = dbhost;
  var $user = dbuser;
  var $password = dbpassword;
  var $dbname = dbname;
  var $error;
  var $debug = true;

  function connect()
  {
    if ( func_num_args() == 3 ) {
      $this->host = func_get_arg( 0 );
      $this->user = func_get_arg( 1 );
      $this->password = func_get_arg( 2 );
    }
    $this->connection = mysql_connect( $this->host, $this->user, $this->password );

  }
  function execute()
  {
global $nnnn;
global $time_mysql;

    if( func_num_args() == 1 ) {
      $db = $this->dbname;
      $query = func_get_arg( 0 );
    }
    if( func_num_args() == 2 ) {
      $db = func_get_arg( 0 );
      $query = func_get_arg( 1 );
    }
    if( $this->debug ) { /*debug( $db . ":\n" . $query );*/ }
    mysql_select_db( $db );
    $result = mysql_query( sql_input($query) );
    $this->error=mysql_error();
    if( $result ) {
      return $result;
    }
    else {
      return false;
    }
  }
  function close()
  {
    mysql_close( $this->connection );
  }
}
//------------------------------------------------------------------------------
class TMySQLQuery
{
  var $connection;
  var $result;
  var $row;
  var $trow;                  //����� ��� ����������
  var $eof;
  var $addnew;
  var $source;
  var $rc;

  //�������������
  function TMySQLQuery()
  {
    $this->connection = new TMySQLConnection;
  }
  //���������� �������, ������ ����������� � ������������� connction
  function open( $query )
  {

  if(!isset($_SESSION["query_count"]))
  {
  		$_SESSION["query_count"]=1;
  }
  else
  {
  		$_SESSION["query_count"]++;
  }
  //echo("<!--".$_SESSION["query_count"].". ".$query."-->\n");

    $this->result = $this->connection->execute( $query );
    $this->movenext();
  }
  //������� � ��������� ������
  function movenext()
  {
    if ( $this->row = @mysql_fetch_assoc( $this->result ) ) {

foreach ($this->row as $rkey => $rvalue)
{
$this->row[$rkey]=stripslashes(sql_out($rvalue));
}

      $this->eof = false;
    }
    else {
      $this->eof = true;
    }
    $this->trow = $this->row;
    $this->rc=@mysql_num_rows($this->result);
  }
  //����������
  function addnew()
  {
    $this->addnew = true;
    unset($this->row);
  }
  //update
  function update()
  {
    if ( $this->addnew ) {
      $sql = "insert into " . $this->source . "( ";
      $values = " values( ";
      reset( $this->row );
      while( list( $key, $val ) = each( $this->row ) ) {
        $sql .= "$key, ";
        $values .= "'$val', ";
      }
      $sql = substr( $sql, 0, -2 ) . " )" . substr( $values, 0, -2 ) . " )";
      $this->result = $this->connection->execute( $sql );
      $this->addnew = false;
    }
    else
    {
      if ( !$this->eof ) {
        $this->source = mysql_field_table( $this->result, 0 );
        $sql = "update " . $this->source . " set ";
        while( list( $key, $val ) = each( $this->row ) ) {
          if( $this->trow[ $key ] != $val ) {
            $sql .= "$key='$val', ";
          }
        }
        $sql = substr( $sql, 0, -2 ) . " where ";
        $i = 0;
        while ( @mysql_field_name( $this->result, $i ) ) {
          $meta = mysql_fetch_field( $this->result, $i );
          if ( $meta->primary_key || $meta->unique_key ) {
            $sql .= mysql_field_name( $this->result, $i ) . "='" . $this->trow[mysql_field_name( $this->result, $i )] . "' and ";
          }
          $i++;
        }
        $sql = substr( $sql, 0, -4 );
        $this->connection->execute( $sql );
      }
    }
  }
  function close()
  {
    @mysql_free_result( $this->result );
    unset( $this->result );
    unset( $this->connection );
  }
}




//������� ��������� ���� �� ������� � ����
function table_isset($t_base)
{
	$t_result=mysql_list_tables(dbname);
	if($t_result==false)
	{
		return false;
	}
	else
	{
		$flag=false;
    		for ($i = 0; $i < mysql_num_rows($t_result); $i++)
		{
		if($t_base==mysql_tablename($t_result, $i)){$flag=true;}
		}
		return $flag;
	}
 	@mysql_free_result($t_result);
}


//������� ��������� ���� �� � ���� �������� ����
function table_column_isset($t_table,$t_column)
{
	$t_result=mysql_list_fields(dbname, $t_table);
	if($t_result==false)
	{
		return false;
	}
	else
	{
		$flag=false;
    		for ($i = 0; $i < mysql_num_rows($t_result); $i++)
		{
		if($t_column==mysql_tablename($t_result, $i)){$flag=true;}
		}
		return $flag;
	}
 	@mysql_free_result($t_result);
}

?>
