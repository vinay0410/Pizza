# Pizza Delivery System

Currently being hosted at Amazon Web Services

Url: http://ec2-13-127-65-239.ap-south-1.compute.amazonaws.com

Note: This system uses Google Maps API, to provide better user experience while Ordering and furthermore to track after Order has been place. So, ensure that Javascript is enabled. 

#### Login Credentials


| User Type     | Email ID               | Password |
| :-----------: |:----------------------:| :-------:|
| Admin         | admin@pizzavilla.com   |   admin  |
| Supervisor    | vinay_sp@pizzavilla.com|     a    |
| Chef          | thomas@gmail.com       |   keller |
| Delivery Staff| axyz@gmail.com         |    a  |

<br>


A system which handles multiple types of users as listed above and co-ordinates between them, to result in efficient and timely delivery.

Users can get real time update of their order, including live tracking of delivery boy on road.



Listed below are some key functionalities for each type of user:

##### Customer
* Can view menu items and add to Cart
* Can checkout Cart and order Items
* Can automatically get the closest outlet, including distance and directions, while checkout
* Can view status of ordered Items
* Can track Order on Map, if on the way


##### Admin
* Can view HeatMap of orders
* Add/edit/delete Outlets
* Add/edit/delete supervisor for an Outlet
* Can search for users, by name, email, address, etc
* Can add/edit/delete menu items, including uploading images for the same

##### Supervisor
* can add/edit/delete staff members, namely chefs and delivery staff for the outlet assigned.


##### Chef
* Can view contents of the items ordered, including ingredients for each item
* Can change the status of Order.

##### Delivery staff
* Can view contents of the items ordered, including ingredients for each item
* Can start delivery for an order while being live tracked
