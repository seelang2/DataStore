<?php
/**
 * Just a file for testing DataStore functionality
 */

require_once('class_datastore.php');

function output($data) {
	$data = json_encode($data);
	exit($data);
}

// utility function for debugging
function pr($data) {
	echo '<pre>' . print_r($data, true) . '</pre>';
} // pr()




$dataset = new DataStore([
	'schema' => [
		'customers' => [
			'schema' => [
				'fields' => ['firstname', 'lastname', 'email'],
				'has' => ['orders']
			],
			'resources' => []
		],
		'orders' => [
			'schema' => [
				'fields' => ['customers.id', 'orderdate', 'ordertotal'],
				'belongsTo' => ['customers']
			],
			'resources' => []
		]
	]
]);

$customerID = $dataset->saveResource(
	'customers',
	[
		'firstname' => 'John',
		'lastname' => 'Doe',
		'email' => 'jdoe@email.com'
	]
);

$dataset->saveResource(
	'orders',
	[
		'customers.id' => $customerID,
		'orderdate' => '2013/10/13',
		'ordertotal' => '325.00'
	]
);

$dataset->saveResource(
	'orders',
	[
		'customers.id' => $customerID,
		'orderdate' => '2014/7/21',
		'ordertotal' => '1287.00'
	]
);

pr($dataset->getCollectionResources('customers'));

pr($dataset->getCollectionResources('orders'));


pr($dataset->getCollectionResources('customers',['getRelated' => ['orders']]));

pr($dataset->getCollectionResources('orders',['getRelated' => ['customers']]));

$customerID2 = $dataset->saveResource(
	'customers',
	[
		'firstname' => 'Jane',
		'lastname' => 'SMith',
		'email' => 'jsmith@email.com'
	]
);

$dataset->saveResource(
	'orders',
	[
		'customers.id' => $customerID2,
		'orderdate' => '2013/10/13',
		'ordertotal' => '325.00'
	]
);

$dataset->saveResource(
	'orders',
	[
		'customers.id' => $customerID2,
		'orderdate' => '2014/7/21',
		'ordertotal' => '1287.00'
	]
);

$customerID3 = $dataset->saveResource(
	'customers',
	[
		'firstname' => 'Alex',
		'lastname' => 'SMith',
		'email' => 'jsmith@email.com'
	]
);



pr($dataset->getCollectionResources('customers',['getRelated' => ['orders']]));


pr($dataset->getCollectionResourcesByField('customers', ['fieldName' => 'lastname', 'fieldValue' => 'SMith']));

$dataset->deleteResource('customers', $customerID2);

pr($dataset->getCollectionResources('customers',['getRelated' => ['orders']]));

pr($dataset->getCollectionResources('orders'));


