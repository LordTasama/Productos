const sideBar = document.getElementById("sidebar");
const active = document.getElementById("active");
const logoIMGCONT = document.getElementById("logoIMGCONT");
const logoMENU = document.getElementById("logoMENU");
const containerALIST = document.getElementById("containerALIST");
const tableResponsive = document.getElementById("tableResponsive");

if (tableResponsive) {
  logoMENU.addEventListener("click", () => {
    if (sideBar.style.height == "10%") {
      sideBar.style.height = "35%";
      logoIMGCONT.style.width = "60px";
      logoIMGCONT.style.height = "60px";
      logoMENU.setAttribute("src", "../assets/media/remove.png");
      logoMENU.setAttribute("srcset", "../assets/media/remove.png");
    } else {
      loadFlex();
    }
  });
}

window.addEventListener("resize", () => {
  loadFlex();
});
function loadFlex() {
  if (window.innerWidth <= 500) {
    sideBar.style.height = "10%";
    active.style.justifyContent = "space-between";
    logoIMGCONT.style.width = "0";
    logoIMGCONT.style.height = "0";
    logoMENU.style.width = "36px";
    logoMENU.style.height = "36px";
    logoMENU.setAttribute("src", "../assets/media/menu.png");
    logoMENU.setAttribute("srcset", "../assets/media/menu.png");
    containerALIST.classList.remove("d-block");
  } else {
    sideBar.style.height = "100%";
    logoMENU.style.width = "0";
    logoMENU.style.height = "0";
    logoIMGCONT.style.width = "60px";
    logoIMGCONT.style.height = "60px";
    active.style.justifyContent = "center";
    containerALIST.classList.add("d-block");
  }
}
loadFlex();

const urlImagenOnline = document.getElementById("urlImageOnline");

if (urlImagenOnline) {
  urlImagenOnline.addEventListener("input", () => {
    const imageOnline = document.querySelector("#imageOnline");
    imageOnline.setAttribute("src", urlImagenOnline.value);
  });
}

const passwordUser = document.getElementById("passwordUser");
if (passwordUser) {
  function inputEventListener() {
    passwordUser.value = "";
    passwordUser.removeEventListener("input", inputEventListener);
  }

  passwordUser.addEventListener("input", inputEventListener);
}
