# REST API Product Catalog

This project is a simple REST API-based product catalog built using PHP with SQLite as the database. It provides endpoints to fetch product data for the frontend and implements filters for categories and price ranges.

---

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
GET /api.php?endpoint=products&categories[]=1&categories[]=2&min_price=20&max_price=30
```

**Response:**
```json
[
  {
    "id":1,
    "name":"Horse",
    "description":"Horse with a flowing mane in the wind",
    "price":23.97,
    "image_path":"\/images\/horse.png",
    "category":"Animals"
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
