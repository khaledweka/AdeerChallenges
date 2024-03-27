## Coding Challenge

### Description

This is a simple application that allows users to make bids on auctions with real time updates.

### Requirements

- PHP 8.3
- laravel 11
- MySQL 8.0
- NPM 8.1

### Installation

1. Clone the repository
2. Run `composer install`
3. Run `npm install`
4. Run `npm run dev`
5. Create a new database
6. Copy the `.env.example` file to `.env` and update the database credentials
7. Run `php artisan migrate`
8. Run `php artisan serve`
9. Visit `http://localhost:8000` in your browser
10. Register a new user
11. Create a new auction or run command `app:create-random-auctions`
12. Visit the auction page and make a bid
13. Watch the real time updates
14. Enjoy!

### Notes

- The application uses Laravel's broadcasting with pusher feature to provide real time updates.
### Improvements

- Add more tests
- Add more features
- Add more validations
- Add more error handling
- Add more logging

### License

### Author

- Name: khaled Al-Wakeel
- Email: khaled_elwakeel@outlook.com

```
