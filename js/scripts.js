// Authencation form validation
const authForm = document.getElementsByName("auth-form");

const nameField = document.getElementById("name");
const emailField = document.getElementById("email");
const passwordField = document.getElementById("password");
const cpasswordField = document.getElementById("cpassword");

const nameError = document.getElementById("name-error");
const emailError = document.getElementById("email-error");
const passwordError = document.getElementById("password-error");
const cpasswordError = document.getElementById("cpassword-error");

const nameRegex = /^[a-zA-Z][a-zA-Z0-9_-]{3,20}$/;
const emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
const passwordRegex =
  /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])/;

authForm.forEach((form) => {
  form.addEventListener("submit", (e) => {
    // name validation
    if (!(form.id === "login-form")) {
      if (nameField.value.trim() === "" || nameField.value.trim() == null) {
        e.preventDefault();
        nameError.textContent = "پێویستە ناو بنووسی!";
      } else if (!nameField.value.trim().match(nameRegex)) {
        e.preventDefault();
        nameError.textContent =
          "پێویستە ناوەکە بە پیت دەست پێبکات و لە نێوان ٣ بۆ ٢٠ پیت بێ، و هێمایەکان تەنها ئەم دووانە ڕێپێدراون - و _";
      } else {
        nameError.textContent = "";
      }
    }

    // email validation
    if (emailField.value.trim() === "" || emailField.value.trim() == null) {
      e.preventDefault();
      emailError.textContent = "پێویستە ئیمەیڵ بنووسی!";
    } else if (!emailField.value.trim().match(emailRegex)) {
      e.preventDefault();
      emailError.textContent = "ئیمەیڵی نادروست!";
    } else {
      emailError.textContent = "";
    }

    // password validation
    if (
      passwordField.value.trim() === "" ||
      passwordField.value.trim() == null
    ) {
      e.preventDefault();
      passwordError.textContent = "پێویستە وشەی نهێنی بنووسی!";
    } else if (passwordField.value.trim().length < 8) {
      e.preventDefault();
      passwordError.textContent = "وشەی نهێنی پێویستە زیاتر بێت لە ٨ پیت!";
    } else if (passwordField.value.trim().length > 100) {
      e.preventDefault();
      passwordError.textContent = "وشەی نهێنی پێویستە کەمتر بێت لە ١٠٠ پیت!";
    } else if (passwordField.value.trim().includes(" ")) {
      e.preventDefault();
      passwordError.textContent = "وشەی نهێنی نابێت هیچ بەشێکی بەتاڵی هەبێت!";
    } else if (passwordField.value.trim().includes("password")) {
      e.preventDefault();
      passwordError.textContent = 'وشەی نهێنی نابێت "password" بێت!';
    } else if (!passwordField.value.trim().match(passwordRegex)) {
      e.preventDefault();
      passwordError.textContent =
        "پێویستە وشەی نهێنی بە لایەنی کەمەوە ژمارەیەک و پیتێکی گەورە و پیتێکی بچووک و هێمایەکی تێدابێت!";
    } else {
      passwordError.textContent = "";
    }

    if (!(form.id === "login-form")) {
      if (
        cpasswordField.value.trim() === "" ||
        cpasswordField.value.trim() == null
      ) {
        e.preventDefault();
        cpasswordError.textContent = "پێویستە وشەی نهێنیی دڵنیایی بنووسی!";
      } else if (cpasswordField.value.trim() !== passwordField.value.trim()) {
        e.preventDefault();
        passwordError.textContent =
          "وشەی نهێنی و وشەی نهێنیی دڵنیایی وەک یەک نیین!";
        cpasswordError.textContent =
          "وشەی نهێنی و وشەی نهێنیی دڵنیایی وەک یەک نیین!";
      } else {
        cpasswordError.textContent = "";
      }
    }
  });

  // Show password checkbox functionality
  const showPasswordCheckbox = document.getElementById("show-pass");

  showPasswordCheckbox.addEventListener("change", function () {
    if (this.checked) {
      passwordField.setAttribute("type", "text");
      cpasswordField.setAttribute("type", "text");
    } else {
      passwordField.setAttribute("type", "password");
      cpasswordField.setAttribute("type", "password");
    }
  });
});

// User box functionality
if (document.getElementById("user-btn") != null)
  document.getElementById("user-btn").addEventListener("click", function () {
    document.getElementById("user-box").classList.toggle("show");
    document.getElementById("search-container").classList.remove("show");
    document.getElementById("nav").classList.remove("show");
    document.getElementById("blur-effect").classList.remove("show");
  });

// Burger menu functionality with blur effect
if (document.getElementById("menu-btn") != null)
  document.getElementById("menu-btn").addEventListener("click", function () {
    document.getElementById("nav").classList.toggle("show");
    document.getElementById("blur-effect").classList.toggle("show");
    document.getElementById("user-box").classList.remove("show");
    document.getElementById("search-container").classList.remove("show");
  });

// Search box functionality
if (document.getElementById("search-btn") != null)
  document.getElementById("search-btn").addEventListener("click", function () {
    document.getElementById("search-container").classList.toggle("show");
    document.getElementById("user-box").classList.remove("show");
    document.getElementById("nav").classList.remove("show");
    document.getElementById("blur-effect").classList.remove("show");
  });

//Changing the color of the dropdown link and the rotation of the Open Triangle icon when the mouse is over the dropdown menu
let dropdownMenuContainer = document.getElementById("dropdown-menu-container");
let dropdownLink = document.getElementById("dropdown-link");
let dropdownLinkIcon = document.getElementById("dropdown-link-icon");

if (!(dropdownMenuContainer == null)) {
  dropdownMenuContainer.addEventListener("mouseover", function () {
    dropdownLink.style.color = getComputedStyle(
      document.documentElement
    ).getPropertyValue("--text-color"); // Change color to the text color
    dropdownLinkIcon.style.transform =
      window.innerWidth < 768 ? "rotate(0)" : "rotate(-90deg)"; // Rotate the icon
  });

  dropdownMenuContainer.addEventListener("mouseout", function () {
    dropdownLink.style.color = ""; // Reset color
    dropdownLinkIcon.style.transform = window.innerWidth < 768 ? "" : ""; // Reset rotation
  });
}

// Loading spinner functionality
const loaderContainer = document.getElementById("loader-container");

if (loaderContainer !== null) {
  window.onload = function () {
    setTimeout(() => {
      loaderContainer.style.display = "none";
    }, 500);
  };
}
