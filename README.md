# REST API Product Catalog

This project is a simple REST API-based product catalog built using PHP with SQLite as the database. It provides endpoints to fetch product data for the frontend and implements filters for categories and price ranges.

---


## API Endpoints

### Base URL
`http://localhost/api`

### Endpoints

#### 1. **Get All Products**
**Endpoint:** `/products`

#### 2. **Get All Category**
**Endpoint:** `/categories`

**Query Parameters:**
- `category` (optional): Filter by category.
- `min_price` (optional): Minimum price.
- `max_price` (optional): Maximum price.

**Example Request:**
```
GET /products?category=Animals&min_price=20&max_price=50
```

**Response:**
```json
[
  {
    "id": 1,
    "name": "Space and Science",
    "description": "A sci-fi themed product.",
    "category": "Space and Science",
    "price": 23.97,
    "image_path": "images/space_science.jpg",
    "created_at": "2024-12-10 10:00:00",
    "updated_at": "2024-12-10 10:00:00"
  }
]
```

### Steps
1. Run migrations
   ```bash
   php migrate.php
   ```

2. Run seeds
   ```bash
   php seeds.php
   ```
