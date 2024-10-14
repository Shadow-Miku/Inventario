
# Inventory Control with Shopping Cart Integration

This project is a web-based application designed for managing product inventories with a built-in shopping cart feature. It provides a robust system for tracking stock, managing products, and facilitating sales, all within a user-friendly interface. The system is built using Laravel, with integrated JavaScript for enhanced interactivity and Bootstrap 5.3.3 for responsive design.



## Key Features

Product Management

    Ability to add, update, and delete products.

    Products are displayed with their relevant details, including images and stock information.

    Image management is integrated, allowing users to upload and update product images with proper previewing in both create and update forms.

Supplier Management

    Full CRUD operations for managing suppliers, including the ability to add, update, and delete supplier details.

    Communication with suppliers is facilitated through WhatsApp integration, enabling users to send messages directly from the application.

    Suppliers are managed via a dynamic modal system to provide a seamless user experience.

Shopping Cart Functionality

    The system includes a shopping cart where users can add products by specifying quantities, view total prices, and adjust quantities as needed.

    Products can be easily removed from the cart, and prices automatically update based on the quantities selected.

    The cart logic is supported by two dedicated tables (sales and salesProducts) to handle orders and manage the relationship between sales and products.

Sales and Inventory Management

    The system tracks all sales and links them to corresponding products in the inventory.

    Users can view past sales and check available stock in real-time.

    The application ensures that inventory is automatically adjusted when a sale is completed, keeping stock data accurate.

Modals for Efficiency

    Dynamic JavaScript-powered modals are used throughout the system to streamline operations. These modals handle tasks like creating and updating products, managing suppliers, and handling cart actions without reloading the page, improving performance.

Responsive Design

    The application is fully responsive, with a layout optimized for both desktop and mobile devices, thanks to Bootstrap 5.3.3.

    A sticky menu feature is implemented for easier navigation when dealing with large datasets.

Enhanced User Experience

    A product administration menu allows users to manage and update inventory efficiently.

    The system also includes the ability to preview old and new images when updating a product, ensuring consistency and accuracy.
    
    Tables and action buttons are visually optimized for a cleaner and more intuitive layout.


## Authors

- [@Shadow-Miku](https://github.com/Shadow-Miku)


## Screenshots
Main Page

![App Screenshot](https://i.pinimg.com/originals/00/b4/44/00b4445496372682c728eb83c1cd1beb.jpg)

Product Registration

![App Screenshot](https://i.pinimg.com/originals/2a/22/04/2a22048de460b3dfe26e3df945a8b7de.jpg)

Product CRUD

![App Screenshot](https://i.pinimg.com/originals/3a/b9/4e/3ab94e1ef1d68d0176df6d9ee0294c51.jpg)

Providers CRUD and Communication

![App Screenshot](https://i.pinimg.com/originals/a9/38/cc/a938cc758f25f0726bce538b91307667.jpg)

Shoping Cart

![App Screenshot](https://i.pinimg.com/originals/58/99/3f/58993f919da3cc230cf9febdc8ebdf54.jpg)

Empty Shoping Cart

![App Screenshot](https://i.pinimg.com/originals/df/04/ef/df04efa5bf82035351d50613995d8684.jpg)