# INKSPIRE - Online Bookstore eCommerce Platform

## Overview

**INKSPIRE** is a dynamic and user-friendly online bookstore web application that allows users to explore, manage, and interact with a wide collection of books. The platform supports full CRUD operations, AJAX-powered interactions for a seamless experience, and integration with Google Maps to visualize store locations.

## Features

- **User Management**  
  - User registration and login with validation checks  
  - Real-time validation of username and email using AJAX

- **Book Management (CRUD)**  
  - Add, edit, delete, and list books  
  - Live search functionality for books using AJAX

- **Interactive Store Locator**  
  - Integrated with **Google Maps API** to display bookstore branches on a responsive, interactive map

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript, Bootstrap, AJAX  
- **Backend:** PHP  
- **Database:** MySQL  
- **APIs:**  
  - Google Maps API – for rendering store locations on the map

## Future Enhancements

- Integrate a **deep learning-based recommendation system** for personalized book suggestions  
- Add **payment gateway integration** for online purchases and checkout (currently not implemented)

## System Testing

To test the application locally:

1. Set up the database using the following SQL files:
   - `database/create_tables.sql` – to create the necessary database schema  
   - `database/init_data.sql` – to insert sample data for testing

2. Use the following demo accounts to log in:

   - **Admin Account**  
     - Username: `admin1_`  
     - Password: `admin1_`

   - **User Account**  
     - Username: `user1_`  
     - Password: `user1_`
