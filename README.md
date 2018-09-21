# DataStore

 The DataStore class is a container to access and store simple 
 collections without the need for a database. The data is saved 
 in JSON format in a text file.

 A collection is a group of resources. Collections are similar to
 database tables. A resource is a group of related fields, similar 
 to the rows in a table.

 DataStore uses an associative array structure to hold the data.

 The schema is defined in PHP using an associative array structure
 and defines each collection's data fields, relationships between
 collections, and resources.

 The DataStore class is a container for the schema and contains 
 methods for accessing the data. The data schema is passed into the 
 class constructor.

 Each collection has two properties:
 schema - contains a list of the collection's data fieldnames, and 
 optional keys for relationships to other collections. The names of 
 related collections are stored as a list in each key.

 resources - associative array of each resource item, keyed by a 
 unique generated index. 

 The collection data will be serialized as JSON and stored in a 
 text file.

 Basic data structure (described using JSON):

	{
		"collectionName": {
			"schema": {
				"fields": ["fieldName1","fieldName2","fieldName3"...],
				"has": ["collectionName",...], // optional
				"belongsTo": ["collectionName",...], // optional
				"HABTM": ["collectionName",...] // optional
			},
			"resources": {
				"primaryKey": {
					"fieldName1": "value",
					"fieldName2": "value",
					"fieldName4": "value",
					...
				}
			}
		},
		...
	}

 Collection relationships

 The terms 'has' and 'belongsTo' represent one-to-many and many-to-one
 relationships respectively. These optional keys in the schema contain 
 arrays of collections related to the current collection.

 If the 'belongsTo' key is set, there must be an entry in the fields
 array matching the collection name ending in '.id' listed in the 
 'belongsTo' which  represents the foreign key that contains the primary 
 key of the related resource in the other collection. This value can be
 overridden in settings.

 HABTM (has-and-belongs-to-many) relationships use link tables in 
 databases to connect two tables together. 

 HABTM relationships are not yet implemented in DataStore.

