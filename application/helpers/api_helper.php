<?php 
function keyAuth($deviceKey = null, $appKey = null)
{
	try 
	{
		if($deviceKey != null && $appKey != null) 
		{
			if($deviceKey == "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IllvdXIgVXNlcidzIElEIiwib3RoZXIiOiJTb21lIG90aGVyIGRhdGEiLCJBUElfVElNRSI6MTU3MDUzMTgwMn0.1C1D7uBw0jItkietzVhtZ3xTx1NR22FzdB1L3NnN9L0" && $appKey == "1C1D7uBw0jItkietzVhtZ3xTx1NR22FzdB1L3NnN9L0") 
			{
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}

	} catch(EXCEPTION $ex){
		echo $ex->getMessage();
	}
}
?>