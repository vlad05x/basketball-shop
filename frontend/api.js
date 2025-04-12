document.addEventListener("DOMContentLoaded", () => {
  const apiUrl = "http://localhost:8000/apiProduct.php"; 
  const container = document.getElementById("products-container");

  fetch(apiUrl)
    .then((response) => response.json())
    .then((data) => {
      const filteredProducts = data.filter(
        (product) =>
          product.category === "Одежда" ||
          product.category === "Кросівки" ||
          product.category === "Мячи"
      );

      container.innerHTML = "";

      filteredProducts.forEach((product) => {
        const imageUrl = product.image
          ? product.image
          : "https://via.placeholder.com/200";

        const productElement = document.createElement("div");
        productElement.classList.add("product-card");
        productElement.innerHTML = `
                            <img class="product-image" src="${imageUrl}" alt="${product.title}">
                            <div class="product-info">
                                <h3 class="product-title">${product.title}</h3>
                                <p class="product-price">Ціна: <span>${product.price} ₴</span></p>
                                <button class="btn btn-primary add-to-cart">Додати в кошик</button>
                            </div>
                        `;
        container.appendChild(productElement);
      });
    })
    .catch((error) => console.error("Помилка:", error));
});
