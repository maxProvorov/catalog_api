<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="product-container" class="container">
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id');

        async function fetchProduct() {
            const container = document.getElementById('product-container');
            const response = await fetch(`api.php?endpoint=product&id=${encodeURIComponent(productId)}`);
            const product = await response.json();

            container.innerHTML = `
                <h1>${product.name}</h1>
                <p>${product.description}</p>
                <p>Price: $${parseFloat(product.price).toFixed(2)}</p>
                <img src="images/${product.image_path}" alt="${product.name}">
            `;
        }

        fetchProduct();
    </script>
</body>
</html>
