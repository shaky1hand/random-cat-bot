# My Cat Bot

A simple Telegram bot built with Symfony that sends a random cat photo on command.

## Features

- **Random Cat Photos:** Sends a random cat photo from an external API.
- **Long Polling:** The bot uses long polling to listen for updates, making it suitable for local development.
- **Dockerized:** The project is containerized with Docker and Docker Compose for easy setup.
- **Environment Variables:** All sensitive data (like the Telegram Bot Token) is stored securely in a `.env` file.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development purposes.

### Prerequisites

You need to have Docker and Docker Compose installed on your system.

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/shaky1hand/random-cat-bot/
   cd my_cat_bot
   ```

2. **Create and configure the `.env` file:**
    Copy the example file and add your Telegram bot token.
  
    ```bash
    cp .env.example .env
    ```
    Open the `.env` file and set your Telegram bot token:
  
    ```bash
    # .env
    TELEGRAM_BOT_TOKEN=exampletoken
    ```

3. **Build and run the containers:**
    ```bash
    docker-compose up -d --build
    ```

    This command will build the Docker images and run the bot in the background.

## How to Use

Once the bot is running, you can send it commands in your Telegram chat:

  - `/start`: Get a welcome message from the bot.
  - `/cat`: (Coming soon) Get a random photo of a cat.

## Technology Stack

  - **PHP 8.1:** The programming language used.
  - **Symfony 6.4:** The framework for building the application.
  - **`telegram-bot/api`:** A PHP library for interacting with the Telegram API.
  - **Docker:** For containerization and easy deployment.

## Contributing

Feel free to submit pull requests or open issues to help improve this project\!
