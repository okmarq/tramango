# Innoscripta API

Innoscripta App is a news aggregator website that pulls articles from various sources and displays them in a clean, easy-to-read format

provide a search type and term to retrieve specific travel options
for example provide flight and search term for flight to get a list of travel options for flight

## About Project

- User authentication and registration
    - Create an account
    - Log in to save preferences and settings
- Article search and filtering
    - Search for articles by keyword
    - Filter search results by date, category, and source
- Personalized news feed
    - Customizable news feed
    - Select preferred sources, categories, and authors
- Mobile-responsive design
    - Optimized for viewing on mobile devices

Data sources used were The Guardian, New York Times, and NewsAPI.org

## Prerequisites

- Laravel
- React
- Database

## Installation

After acquiring the app on your local machine
run `php artisan migrate --seed`
Use the endpoints or the front end to interact with the api

## Usage

The application uses these endpoints
`/register`
`/login`
`/logout`
`/preference/save`
`/articles`
`/article/search`

clone the Innoscripta project
`git clone https://github.com/okmarq/innoscripta.git`

change directory into the Innoscripta project
`cd innoscripta`

rename the .env.example file to .env, filling out the required details
`DB_DATABASE`
`DB_USERNAME`
`DB_PASSWORD`

clone the Innoscripta Laravel project
`git clone https://github.com/okmarq/innoscripta-laravel.git`

change directory into the Innoscripta Laravel project
`cd innoscripta-laravel`

rename the .env.example file to .env, filling out the required details
`DB_DATABASE`
`DB_USERNAME`
`DB_PASSWORD`
`GUARDIAN_API_KEY`
`NYTIMES_API_KEY`
`NEWSAPI_API_KEY`

run the following commands
`php artisan key:generate`

change directory into the Innoscripta React project
`cd ../innoscripta-react`

clone the Innoscripta React project
`git clone https://github.com/okmarq/innoscripta-react.git`

change directory into the Innoscripta project
`cd ..`

run the following commands
`docker-compose up --build`

visit the react application at
`http://localhost:5173`

## Contributing

All contributions are welcome.

## Contact

You can contact me at [okmarq@gmail.com](mailto:okmarq@gmail.com 'Joel Okoromi')

## License

This project uses no license
