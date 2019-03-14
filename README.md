# shopping CRUD application usign PHP

## Prerequisites
- PHP <=7.1.8
- Composer
## Features
- CRUD for products
- API authentication via [jwt](https://jwt.io/)
- Integration tests usign [codeception](https://codeception.com)
- MVC pattern
## API Endpoints
| path | method | body | decsription |
|------|--------|------|-------------|
| /signup | POST | {username,name,password,country,addresse} | Sign up to the application |
| /login | POST | {username,password} | Sign in to the application |
| /product/create | POST | {name,price,inventory,description,jwt} | Create a new product |
| /product/list | GET | {} | Retrive a list of all the created products |
| /product/delete | POST | {id, username, jwt} | Delete a product by id |
| /product/update | POST | {id,name,price,inventory,description,jwt} | Update product by id |
| /product/item/{id} | GET | {} | Retrive a single product by id |
| /order/list | GET | {} | Retrive a list of all the created orders |
| /order/view/{id} | GET | {} | Retrive a single order by id |

