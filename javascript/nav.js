    // Toggle do menu hambúrguer
    const ham = document.querySelector(".nav-ham");
    const navMenu = document.querySelector(".nav-menu");

    ham.addEventListener("click", () => {
        ham.classList.toggle('active');
        navMenu.classList.toggle('active');
    });

    // Função de máscara (ex: CPF)
    function mascara(i) {
        let v = i.value;

        if (isNaN(v[v.length - 1])) {
            i.value = v.substring(0, v.length - 1);
            return;
        }

        i.setAttribute("maxlength", "14");
        if (v.length === 3 || v.length === 7) i.value += ".";
        if (v.length === 11) i.value += "-";
    }
    