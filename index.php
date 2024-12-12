<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catalog</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="catalog">
        <main>
            <div id="products"></div>
        </main>
        
        <aside>
            <form id="filters">
                <h3>Categories</h3>
                <div id="categories"></div>
                <h3>Price</h3>
                <div class="prices">
                    <label>Min: <input type="number" name="min_price" value="0"></label>
                    <label>Max: <input type="number" name="max_price" value="100"></label>
                </div>
                <button type="submit">Filter</button>
            </form>
        </aside>
    </div>

    <script>
        async function fetchCategories() {
            const response = await fetch('api.php?endpoint=categories');
            const categories = await response.json();
            const container = document.getElementById('categories');
            container.innerHTML = categories.map(cat => `
                <label>
                    <input type="checkbox" name="categories[]" value="${cat.id}">
                    ${cat.name}
                </label>
            `).join('');
        }

        async function fetchProducts(query = '') {
            const response = await fetch(`api.php?endpoint=products&${query}`);
            const products = await response.json();
            const container = document.getElementById('products');
            container.innerHTML = products.map(product => `
                <div class="product-card">
                    <a href="product.php?id=${product.id}">
                        <img src="${product.image_path}" alt="${product.name}">
                        <h3>${product.category}</h3>
                        <p>${product.price} AUD</p>
                        <a href="${product.image_path}" download="${product.name}.png" class="download-button">Download Image</a>
                    </a>
                </div>
            `).join('');
        }

        document.getElementById('filters').addEventListener('submit', (e) => {
            e.preventDefault();
            const params = new URLSearchParams(new FormData(e.target));
            fetchProducts(params.toString());
        });

        fetchCategories();
        fetchProducts();
    </script>
</body>
</html>
