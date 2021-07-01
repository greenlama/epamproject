# epamproject
Diploma task

Application

Variant 1. Using API https://affiliate.itunes.apple.com/resources/documentation/itunes-store-web-service-search-api/ get all data about “Pink Floyd" and store it into your DB:
kind, collectionName, trackName, collectionPrice, trackPrice, primaryGenreName, trackCount, trackNumber, releaseDate.
Output the data for the year of releaseDate (the year is set) in the form of a table and sort them by trackPrice in descending order.

Develop a simple (lightweight) 3-tire application (front-end, back-end, database).
Back-end (collects data) must:
1. Retrieve a portion of data from API (see in your Variant) and store it in a database
2. Update data on demand
3. Update DB schema if needed on app’s update
Front-end (outputs data) must:
1. Display any portion of the data stored in the DB
2. Provide a method to trigger data update process
Database:
1. Choose Database type and data scheme in a suitable manner. 
2. Data must be stored in a persistent way
3. It’s better to use cloud native DB solutions like an RDS/AzureSQL/CloudSQL.

Create a simple Web-application (see the description in the “Application” section) and CI/CD infrastructure and pipeline for it.
Acceptance Criteria and presentation
A short presentation (.ppt or other) which contains description of the solution should be prepared and sent to the commission before a demo session.
The working application with the pipeline is to be demonstrated live on a “protection of the diploma” session for experts with comments and explanation of the details of the implementation, reasons of choosing tools and technologies.

You can choose any cloud provider taking into account possible extra costs for the resources. As an example, you can use 3-workers node configuration with 1 CPU/8GB on each one in GCP under free tier.
