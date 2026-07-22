console.log("JS LOADED");

/* ================= NAVBAR ================= */
const burger = document.getElementById('burger');
const navLinks = document.querySelector('.nav-links');
const dropdown = document.querySelector('.dropdown');

if (burger && navLinks) {
    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        navLinks.classList.toggle('active');
    });
}

/* ================= MOBILE DROPDOWN ================= */

const dropdownToggle =
    document.querySelector(".dropdown-toggle");

if (dropdown && dropdownToggle) {

    dropdownToggle.addEventListener("click", () => {

        if (window.innerWidth <= 768) {

            dropdown.classList.toggle("active");

        }

    });

}


/* ================= SHOP LOGIC ================= */

const grid = document.getElementById("productGrid");
const categoryFilter = document.getElementById("filterCategory");
const priceFilter = document.getElementById("filterPrice");
const sortSelect = document.getElementById("sortPrice");

if (grid) {

    // GET PRODUCTS
    function getProducts() {
        return Array.from(grid.querySelectorAll(".product"));
    }

    // URL PARAMS
    const urlParams = new URLSearchParams(window.location.search);

    const typeParam =
    urlParams.get("type");

    const categoryParam =
        urlParams.get("category");

    // FILTER PRODUCTS
    function filterProducts() {

        const products = getProducts();

        // FILTER VALUES
        const selectedCategory =
            categoryFilter
                ? categoryFilter.value.toLowerCase()
                : "all";

        const selectedPrice =
            priceFilter
                ? priceFilter.value
                : "all";

        

        products.forEach(product => {

            let show = true;

const productCategory =
(product.dataset.category || "").toLowerCase();

const productType =
(product.dataset.type || "").toLowerCase();

const productPrice =
parseInt(product.dataset.price) || 0;

/* ================= CATEGORY FILTER ================= */

if (
    selectedCategory !== "all" &&
    productCategory !== selectedCategory
) {
    show = false;
}

/* ================= TYPE FILTER ================= */

if (
    typeParam &&
    typeParam.toLowerCase() !== "new" &&
    productType !== typeParam.toLowerCase()
) {
    show = false;
}

/* ================= HOMEPAGE CATEGORY PARAM ================= */

if (
    categoryParam &&
    productCategory !== categoryParam.toLowerCase()
) {
    show = false;
}

            /* ================= PRICE FILTER ================= */

            if (
                selectedPrice === "low" &&
                productPrice >= 2000
            ) {
                show = false;
            }

            if (
                selectedPrice === "mid" &&
                (productPrice < 2000 || productPrice > 4000)
            ) {
                show = false;
            }

            if (
                selectedPrice === "high" &&
                productPrice <= 4000
            ) {
                show = false;
            }

            // SHOW / HIDE
            product.style.display = show ? "" : "none";

        });
    }

    // SORT PRODUCTS
    function sortProducts() {

        let items = getProducts();

        if (sortSelect) {

            if (sortSelect.value === "low") {

                items.sort((a, b) => {
                    return a.dataset.price - b.dataset.price;
                });

            } else if (sortSelect.value === "high") {

                items.sort((a, b) => {
                    return b.dataset.price - a.dataset.price;
                });

            }

        }

        // RE-APPEND
        items.forEach(item => {
            grid.appendChild(item);
        });
    }

    // APPLY ALL
    function applyAll() {
        filterProducts();
        sortProducts();
    }

    // EVENTS
    if (categoryFilter) {
        categoryFilter.addEventListener("change", applyAll);
    }

    if (priceFilter) {
        priceFilter.addEventListener("change", applyAll);
    }

    if (sortSelect) {
        sortSelect.addEventListener("change", applyAll);
    }

    // RUN ON LOAD
    applyAll();
}
/* ================= SEARCH TOGGLE ================= */

const searchToggle = document.getElementById("searchToggle");
const searchBox = document.getElementById("searchBox");
const searchInput = document.getElementById("searchInput");

// OPEN / CLOSE SEARCH
if (searchToggle && searchBox) {
    searchToggle.addEventListener("click", () => {
        searchBox.classList.toggle("active");

        if (searchBox.classList.contains("active")) {
            searchInput.focus();
        }
    });

    // close when clicking outside
    document.addEventListener("click", (e) => {
        if (!searchBox.contains(e.target) && !searchToggle.contains(e.target)) {
            searchBox.classList.remove("active");
        }
    });
}


/* ================= SEARCH FUNCTION ================= */

if (searchInput) {
    searchInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            const query = this.value.trim().toLowerCase();

            if (query !== "") {
                window.location.href = `SearchPage.php?q=${encodeURIComponent(query)}`;
            }
        }
    });
}

/* ================= LOGIN ================= */

function login() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (email && password) {
        localStorage.setItem("user", email);
        alert("Logged in ✅");
        window.location.href = "ShopPage.php";
    } else {
        alert("Fill all fields ❌");
    }
}

// CHECK LOGIN 
function checkLogin() {
    const user = localStorage.getItem("user");

    if (!user) {
        window.location.href = "LoginPage.php";
    }
}

/* ================= CART ================= */

let cart = JSON.parse(localStorage.getItem("cart")) || [];

function saveCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

/* ================= ADD TO CART ================= */

document.addEventListener("click", function (e) {

    if (e.target.classList.contains("add-to-cart-btn")) {

        let item;

        /* SHOP PAGE */
        const productCard = e.target.closest(".product");

        if (productCard) {

            const name =
                productCard.querySelector("h4").innerText;

            const price =
                productCard.dataset.price;

            const img =
                productCard.querySelector("img").src;

            item = { name, price, img };

        }

        /* PRODUCT PAGE */
        else if (document.getElementById("productName")) {

            const name =
                document.getElementById("productName").innerText;

            const price =
                document.getElementById("productPrice")
                    .innerText.replace("Rs.", "");

            const img =
                document.getElementById("mainImage").src;

            /* GET SELECTED SIZE */
            const selectedSize =
                document.querySelector(".sizes button.active");

            const size =
                selectedSize
                    ? selectedSize.innerText
                    : "Not Selected";

            item = { name, price, img, size };

        }

        if (item) {

            cart.push(item);

            saveCart();

            alert("Added to cart 🛒");

        }

    }

});

/* ================= SHOW CART ================= */

const cartContainer = document.getElementById("cartItems");

if (cartContainer) {

    let total = 0;

    cart.forEach((item, index) => {
        total += parseInt(item.price);

        cartContainer.innerHTML += `
            <div class="cart-item">
                <img src="${item.img}" width="80">
                <h4>--${item.name}</h4>
                <p>-Rs.${item.price}</p>
                <p>-Size: ${item.size || "N/A"}</p>
                <button class="remove-btn" onclick="removeItem(${index})">Remove</button>
            </div>
        `;
    });

    document.getElementById("total").innerText = "Total: Rs." + total;
}

// REMOVE ITEM
function removeItem(index) {
    cart.splice(index, 1);
    saveCart();
    location.reload();
}

const checkoutBtn = document.querySelector(".checkout-btn");

if (checkoutBtn) {
    checkoutBtn.addEventListener("click", () => {
        if (cart.length === 0) {
            alert("Your cart is empty 😐");
        } else {
            alert("Proceeding to checkout...");
            
        }
    });
}

/* ================= SIZE SELECT ================= */

const sizeButtons =
    document.querySelectorAll(".sizes button");

sizeButtons.forEach(button => {

    button.addEventListener("click", () => {

        // REMOVE ACTIVE FROM ALL
        sizeButtons.forEach(btn => {
            btn.classList.remove("active");
        });

        // ADD ACTIVE TO CLICKED
        button.classList.add("active");

    });

});



/* ================= LOADER ================= */

document.addEventListener("DOMContentLoaded", () => {
    const loader = document.getElementById("loader");

    if (loader) {
        setTimeout(() => {
            loader.classList.add("hide");
        }, 500); // faster and smoother
    }
});


/* ================= LOGIN FORM RELOAD ================= */
document.getElementById("loginForm").addEventListener("submit", function(e){

    e.preventDefault();

    let formData = new FormData(this);

    fetch("login.php",{

        method:"POST",

        body:formData

    })

    .then(response=>response.text())

    .then(data=>{

        if(data.trim() === "success"){

            window.location.replace("index.php");

        }else{

           let errorBox = document.getElementById("loginError");

if(data === "success"){

    window.location.replace("index.php");

}else{

    errorBox.style.display = "block";
    errorBox.innerHTML = data;

}

        }

    });

});

/* ================= SIGNUP FORM RELOAD================= */

document.getElementById("signupForm").addEventListener("submit", function(e){

    e.preventDefault();

    let formData = new FormData(this);

    fetch("signup.php",{

        method:"POST",
        body:formData

    })

    .then(response=>response.text())

    .then(data=>{

        if(data=="success"){

            window.location.replace("LoginPage.php");

        }else{

            document.getElementById("signupError").style.display="block";
            document.getElementById("signupError").innerHTML=data;

        }

    });

});

document.querySelectorAll("#signupForm input").forEach(input=>{

    input.addEventListener("input",()=>{

        let error=document.getElementById("signupError");

        error.style.display="none";
        error.innerHTML="";

    });

});