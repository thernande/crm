<?php
	class LogcustomersController extends AppController{
		public $helpers = array('Html','Form', 'Js', 'PhpExcel');
    	public $components = array('Session', 'Paginator', 'RequestHandler','Cookie');
    	public $name = 'Logcustomers';
    	
    	function showGridLog($id=null)
        {

    // get how many rows we want to have into the grid - rowNum parameter in the grid
   
    $limit = $this->request->query['rows'];

    // get index row - i.e. user click to sort. At first time sortname parameter -
    // after that the index from colModel
    $sidx = $this->request->query['sidx'];

    // sorting order - at first time sortorder
    $sord = $this->request->query['sord'];

    $page = $this->request->query['page'];


    // if we not pass at first time index use the first column for the index or what you want
    if( !$sidx ) $sidx = 1;
            //calculate no of rows from query
            $row=$this->Logcustomer->find('count', array('conditions' => array('customer_id' => $id)));
            $count = $row;

    // calculate the total pages for the query
    if( $count > 0 )
    {
        $total_pages = ceil($count / $limit);
    }
    else
    {
        $total_pages = 0;
    }

    // if for some reasons the requested page is greater than the total
    // set the requested page to total page
    if( $page > $total_pages ) $page = $total_pages;

    // calculate the starting position of the rows
    $start = $limit * $page - $limit;

    // if for some reasons start position is negative set it to 0
    // typical case is that the user type 0 for the requested page
    if( $start < 0 ) $start = 0;
	
    //fetch only pure data avoiding unnecessay loading of related/associated data
            $this->Logcustomer->recursive=-1;
	if(!empty($this->request->query['filters'])){
		$rule=$this->request->query['filters']['rule'];
		$resultado=$this->Logcustomer->find('all',array('fields' => array('Logcustomer.id','Logcustomer.name', 'Logcustomer.nit', 'Logcustomer.dress', 'Logcustomer.state' 'Logcustomer.created'),'ORDER =' => $sidx.' '.$sord, 'limit' => $start,$limit, 'conditions' => array($rule['field'].' LIKE = ' => $rule['data'].'%', 'customer_id' => $id)));
	}
else{
	$resultado=$this->Logcustomer->find('all',array('fields' => array('Logcustomer.id','Logcustomer.name', 'Logcustomer.nit', 'Logcustomer.dress', 'Logcustomer.state' 'Logcustomer.created'),'ORDER BY =' => $sidx.' '.$sord, 'limit' => $start,$limit, 'conditions' => array('customer_id' => $id)));
}


            
          // $resultado=$this->Customer->find('all',array('fields' => array('id','name','phone','dress','state','created'),'order' => $sort_range,'limit' => $limit_range)); 

            //setting the response object

            $responce=new stdClass();
            $responce->page=$page;
            $responce->total_pages=$total_pages;
            $responce->records=$count;

			$i=0;
			            
            foreach($resultado as $row)
            {
            	
                $responce->rows[$i]['id']=$row['Logcustomer']['id'];
                $responce->rows[$i]['cell']=array($row['Logcustomer']['id'],$row['Logcustomer']['nit'],$row['Logcustomer']['name'], $row['Logcustomer']['dress'],$row['Logcustomer']['state'], $row['Logcustomer']['created']);
                
                $i++;
            }

           echo json_encode($responce);

            exit();

        }
	}
?>