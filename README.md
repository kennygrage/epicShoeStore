# Shoe Database

##### Shoe Database, 8/28/2015

#### Kenny Grage

## Description

This app will allow users to create, read, update, and delete from a joined list of
stores and shoes sold in the stores.

## Setup

- clone this repository
- Run $ composer update in project folder
- Start mysql server and adjust ports/root directory (default is localhost)
- Start php server in web directory folder port 8000
- navigate web browser to localhost:8000
- Run phpmyadmin and import database from folder.


## Technologies Used

PHP, phpunit, Silex, Twig, HTML, CSS, Boostrap, Symfony, MySQL, PhpMyAdmin, MAMP

## MySQL Commands Used

CREATE DATABASE shoes;
USE shoes;
CREATE TABLE shoes(id serial PRIMARY KEY, shoe_name varchar(255));
CREATE TABLE shoes_stores(id serial PRIMARY KEY, shoes_id int, stores_id int);
CREATE TABLE stores(id serial PRIMARY KEY, store_name varchar(255));

shoes_test was copied in phpmyadmin.

Pleae also refer to the database flowchart entitled 'Database "shoes" Flowchart.pdf' in this repository for layout plan.

### Legal


Copyright (c) 2015 Kenny Grage

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
