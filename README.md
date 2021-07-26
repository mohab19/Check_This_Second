## Order Registering simulation:

  This Project simulates the way that orders is being exported to a shipment company
  APIs to be shipped to the customer.

### Project Features:

  This project uses the last versions of both **Laravel** and **PHP**
  The project is done as a *Backend* development, so no views are included.
  The Project is also dockerized so you don't need any dependencies.
  You should find a **Postman** collection json file included in the project's
  root folder.

### How to setup the project:

  Please clone the project to your PC and then open a *CMD* inside the root folder
  first type the following command:

    ./vendor/bin/sail composer update

  After the downloading and installation is finished, make sure your docker is
  running, Then write the following command:

	./vendor/bin/sail up

  If a dependency is needed the docker file will clone and install it, otherwise,
  This should be fast.
  After that please migrate the database by writing the following command:

    ./vendor/bin/sail artisan migrate

  After all the tables are migrated, the project is written with seeders,
  So to write some fast and fake data, please write the following:

	./vendor/bin/sail artisan db:seed

  This should make the project ready to use, pleas open the **Postman** and import
  the file and start use the project.

  #### Testing the code:

  The code is including with some unit test cases, you should be able to test it
  using the following command:

    ./vendor/bin/sail artisan test


### TODO LIST:
  This project is yet to be updated and use the latest technologies and techniques.
  Please follow up to check it.
