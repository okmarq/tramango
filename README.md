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

- `register`
  - to register a user 
- `login`
  - to sign in a user 
- `admin/register`
  - to register an admin user (can be done by only another admin user) 
- `logout`
  - to sign out a user 
- `bookings`
  - crud bookings 
- `flights`
    - crud flights (admin only)
- `hotels`
    - crud hotels (admin only)
- `tours`
    - crud tours (admin only)
- `roles`
    - crud roles (admin only)
- `locations`
    - crud locations (admin only)
- `statuses`
    - crud statuses (admin only)
- `travels`
    - c-ud travel options (admin only)
    - everyone can read travel options. 
      - I reckon this endpoint will receive over 75% of all the requests coming to Tramango
      - it can be scaled vertically when the server load is close to being exceeded via additional servers with a load balancer
- `travel/search`
    - search travel options
- `users`
    - read users (admin only)
    - a user can read own profile
- `payments`
  - only admin can view payments
- `payment/pay`
  - a user can initiate POST request payment for a booking, with the payload `booking_id`, `amount`, `currency`, `email` 
    - usually, a frontend will use the `booking_id` to query the amount
    - the email can be taken from the user's session given the user will always be signed in  
    - payment from the gateway will automatically initiate a callback to the route below
- `payment/gateways/{provider}/callback/{reference}`
  - this route will verify the payment then upon successful payment verification, a transaction to save payment and update booking status to database will get called. 

## Contributing

All contributions are welcome.

## Contact

You can contact me at [okmarq@gmail.com](mailto:okmarq@gmail.com 'Joel Okoromi')

## License

This project uses no license
