Managers Class that extends adb
A class that specifies the features of the task and it also extends to interface with mysql.

Methods
addManager() : This methods runs a query that adds a manger into the database. This query simply takes in the Manager\_Name, Email\_Address, Id\_Number, Phone\_Number and saves or stores them. Upon success it adds the query and gives a message Successfully Added Manager else it displays a message Error Adding Manager.

deleteManager() : This method runs a query in a parameter $managerName from managers and then calls the data attached to the $managerName and deletes the managers data. Upon success it displays a message Manager Successfully Deleted, else it displays Error Deleting Manager.

updateManager() : This method runs a query from the Managers table and updates the information of a particular manager. Upon a successful update, it returns a message showing it has successfully updated.

Search\_by\_manager() This method runs a query in the managers table whiles searching for the name of a particular manager. It returns a message on a successful search.

Display\_manager(): . This method, upon interacting displays the managers in the database.

getManager(); This method returns a manager after a successful query from the managers table.