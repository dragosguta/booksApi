# API Implementation using Laravel 5.x

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)

Building APIs with Laravel. Exposes 'book' objects with appropriate fields. Built with a LAMP stack. Tests included with phpUnit.

Must set up VM/LAMP environment and include .env as per .env.example

```json
{
    "data": [
        {
            "title": "Et ab.",
            "author": "Sed.",
            "description": "Necessitatibus voluptatem maxime eos vero nobis.",
            "checked out": false
        },
        {
            "title": "Consequatur.",
            "author": "Rem.",
            "description": "Sapiente quidem qui commodi.",
            "checked out": false
        },
        {
            "title": "Voluptatum.",
            "author": "Quis.",
            "description": "Sequi quia corporis eius.",
            "checked out": false
        },
        {
            "title": "Aspernatur.",
            "author": "Ipsam.",
            "description": "Quia expedita sint quia ab delectus.",
            "checked out": false
        },
        {
            "title": "Rerum.",
            "author": "Maiores eius.",
            "description": "Voluptas consequuntur modi explicabo.",
            "checked out": false
        }
    ],
    "paginator": {
        "total_count": 75,
        "current_page": 3,
        "total_pages": 15,
        "limit": "5"
    }
}
```

