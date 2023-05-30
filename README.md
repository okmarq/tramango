# Tramango API

Tramango is an agency that provides travel options to its customers with the goal of making the process effortless and enjoyable.

## About Project

A backend-focused application using PHP and Laravel that provides an API for managing travel bookings. The application allows users to search for available travel options, make bookings, retrieve booking details, and perform basic CRUD operations on booking data.

## Prerequisites

- Laravel
- Database
- Payment Gateways

## Installation

clone the Tramango API project

`git clone https://github.com/okmarq/tramango.git`

change directory into the Tramango API project

`cd tramango`

rename the .env.example file to .env, filling out the required details
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `PAYSTACK_PUBLIC`
- `PAYSTACK_SECRET`

run `php artisan key:generate`

run `php artisan migrate --seed` 

This will seed some records for the models `Hotel`, `Flight` `Location`, `Tour`, `Role`, `Status`, `TravelOption`.

## Usage

This project is an API that uses JWT tokens to authenticate all of its endpoints save the `register`, `login`, `payment.gateway.callback` endpoint

Therefore, every request besides the indicated endpoint must supply a Bearer token in the header

Every response is in JSON format.

### Travel Options API Endpoints

- `travels`
  - A user can view any travel option
  - An admin can crud travel options
- `travel/search`
  - A user can search for travel options by `type`, `location_id`, `date`, `min_price or 0`, and `max_price`

### Booking API Endpoints

- `bookings`
  - a signed-in user can create from a travel option
  - additionally, a user can view, update, soft delete (cancel) and restore its own booking
  - an admin can view any, restore (after Tramango is sure the user wil not have a change of heart) and force delete a booking

The application uses these endpoints

- `api/register`
  - Description: to register a user
  - Parameters: `first_name`, `last_name`, `email`, `password`, `password_confirmation`
  - Returns: 201 http code, User resource and JWT token
- `api/login`
  - Description: to sign in a user
  - Parameters: `email`, `password`
  - Returns: 200 http code, User resource and JWT token
- `api/admin/register`
  - Description: to register an admin user (can be done by only another admin user)
  - Parameters: `first_name`, `last_name`, `email`, `password`, `password_confirmation`
  - Returns: 201 http code, User resource and JWT token 
- `api/logout`
  - Description: to sign out a user
  - Parameters: none
  - Returns: 200 http code and logged out message
- `api/bookings`
  - create
    - Description: create a booking
    - Parameters: `user_id`, `travel_option_id`, `guest`
    - Returns: 201 http code, Booking resource
    - Method: POST
  - read
    - Description: retrieve bookings
    - Parameters: none
    - Returns: 200 http code and Booking collection
    - Method: GET
  - read
      - Description: retrieve booking
      - Parameters: `id`
      - Returns: 200 http code and Booking resource
      - Method: GET
  - update
    - Description: update booking
    - Parameters: `user_id`, `travel_option_id`, `guest`
    - Returns: 200 http code and Booking resource
    - Method: PUT
  - delete
    - Description: delete booking
    - Parameters: none
    - Returns: 204 http code
    - Method: DELETE
- `api/flights`
    - crud flights (admin only)
    - create
        - Description: create a flight
        - Parameters: `name`
        - Returns: 201 http code, Flight resource
        - Method: POST
    - read
        - Description: retrieve flights
        - Parameters: none
        - Returns: 200 http code and Flight collection
        - Method: GET
    - read
        - Description: retrieve flight
        - Parameters: `id`
        - Returns: 200 http code and Flight resource
        - Method: GET
    - update
        - Description: update flight
        - Parameters: `name`
        - Returns: 200 http code and Flight resource
        - Method: PUT
    - delete
        - Description: delete flight
        - Parameters: none
        - Returns: 204 http code
        - Method: DELETE
- `api/hotels`
    - crud hotels (admin only)
    - create
        - Description: create a hotel
        - Parameters: `name`
        - Returns: 201 http code, Hotel resource
        - Method: POST
    - read
        - Description: retrieve hotels
        - Parameters: none
        - Returns: 200 http code and Hotel collection
        - Method: GET
    - read
        - Description: retrieve hotel
        - Parameters: `id`
        - Returns: 200 http code and Hotel resource
        - Method: GET
    - update
        - Description: update hotel
        - Parameters: `name`
        - Returns: 200 http code and Hotel resource
        - Method: PUT
    - delete
        - Description: delete hotel
        - Parameters: none
        - Returns: 204 http code
        - Method: DELETE
- `api/tours`
    - crud tours (admin only)
    - create
        - Description: create a tour
        - Parameters: `name`
        - Returns: 201 http code, Tour resource
        - Method: POST
    - read
        - Description: retrieve tours
        - Parameters: none
        - Returns: 200 http code and Tour collection
        - Method: GET
    - read
        - Description: retrieve tour
        - Parameters: `id`
        - Returns: 200 http code and Tour resource
        - Method: GET
    - update
        - Description: update tour
        - Parameters: `name`
        - Returns: 200 http code and Tour resource
        - Method: PUT
    - delete
        - Description: delete tour
        - Parameters: none
        - Returns: 204 http code
        - Method: DELETE
- `api/roles`
    - crud roles (admin only)
    - create
        - Description: create a role
        - Parameters: `name`
        - Returns: 201 http code, Role resource
        - Method: POST
    - read
        - Description: retrieve roles
        - Parameters: none
        - Returns: 200 http code and Role collection
        - Method: GET
    - read
        - Description: retrieve role
        - Parameters: `id`
        - Returns: 200 http code and Role resource
        - Method: GET
    - update
        - Description: update role
        - Parameters: `name`
        - Returns: 200 http code and Role resource
        - Method: PUT
    - delete
        - Description: delete role
        - Parameters: none
        - Returns: 204 http code
        - Method: DELETE
- `api/locations`
    - crud locations (admin only)
    - create
        - Description: create a location
        - Parameters: `name`
        - Returns: 201 http code, Location resource
        - Method: POST
    - read
        - Description: retrieve locations
        - Parameters: none
        - Returns: 200 http code and Location collection
        - Method: GET
    - read
        - Description: retrieve location
        - Parameters: `id`
        - Returns: 200 http code and Location resource
        - Method: GET
    - update
        - Description: update location
        - Parameters: `name`
        - Returns: 200 http code and Location resource
        - Method: PUT
    - delete
        - Description: delete location
        - Parameters: none
        - Returns: 204 http code
        - Method: DELETE
- `api/statuses`
    - crud statuses (admin only)
    - create
        - Description: create a status
        - Parameters: `name`
        - Returns: 201 http code, Status resource
        - Method: POST
    - read
        - Description: retrieve statuses
        - Parameters: none
        - Returns: 200 http code and Status collection
        - Method: GET
    - read
        - Description: retrieve status
        - Parameters: `id`
        - Returns: 200 http code and Status resource
        - Method: GET
    - update
        - Description: update status
        - Parameters: `name`
        - Returns: 200 http code and Status resource
        - Method: PUT
    - delete
        - Description: delete status
        - Parameters: none
        - Returns: 204 http code
        - Method: DELETE
- `api/travels`
    - c-ud travel options (admin only)
    - create
        - Description: create a travel option
        - Parameters: `type`, `travel_id`, `travel_type`, `location_id`, `price`, `start_date`, `end_date`
        - Returns: 201 http code, Travel option resource
        - Method: POST
    - update
        - Description: update travel option
        - Parameters: `type`, `travel_id`, `travel_type`, `location_id`, `price`, `start_date`, `end_date`
        - Returns: 200 http code and Travel option resource
        - Method: PUT
    - delete
        - Description: delete travel option
        - Parameters: none
        - Returns: 204 http code
        - Method: DELETE
  - non-admin user allowed endpoints
  - read
      - Description: retrieve travel options
      - Parameters: none
      - Returns: 200 http code and Travel option collection
      - Method: GET
  - read
      - Description: retrieve travel option
      - Parameters: `id`
      - Returns: 200 http code and Travel option resource
      - Method: GET
  - everyone can read travel options. 
    - I reckon this endpoint will receive over 75% of all the requests coming to Tramango
    - it can be scaled vertically when the server load is close to being exceeded via additional servers with a load balancer
- `api/travel/search`
    - search travel options
      - Description:
      - Parameters: `type`, `location_id`, `date`, `price`
      - Returns: 200 http code and Travel option collection
      - Method: GET
- `api/users`
    - read users (admin only)
        - Description: retrieve users
        - Parameters: none
        - Returns: 200 http code and User collection
        - Method: GET
    - read user
        - Description: retrieve user own profile
        - Parameters: `id`
        - Returns: 200 http code and User resource
        - Method: GET
- `api/payments`
  - only admin can view payments
    - Description: retrieve payments
    - Parameters: none
    - Returns: 200 http code and Payment collection
    - Method: GET
- `api/payment/pay`
  - a user can initiate POST request payment for a booking, with the payload `booking_id`, `amount`, `currency`, `email` 
    - usually, a frontend will use the `booking_id` to query the amount
    - the email can be taken from the user's session given the user will always be signed in  
    - payment from the gateway will automatically initiate a callback to the route below
    - follow the checkout url from the return payload to got to paystack's gateway to complete payment
  - Description: make payment
  - Parameters: `booking_id`, `amount`, `currency`, `email`
  - Returns: 201 http code and Payment information payload for transaction verification
  - Method: POST
- `api/api/payment/gateways/{provider}/callback/{reference}`
  - this route will verify the payment then upon successful payment verification
    - transaction to save payment and update booking status to database will get called
  - Description: verify payment
  - Parameters: `provider`, `reference`, other details are provided from the payment payload automatically
  - Returns: 201 http code and payment successful message
  - Method: POST

## Contributing

All contributions are welcome.

## Contact

You can contact me at [okmarq@gmail.com](mailto:okmarq@gmail.com 'Joel Okoromi')

## License

This project uses no license
