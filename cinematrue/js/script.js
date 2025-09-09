 const posters = [
    "img/monkey.avif",
    "img/flow.jpg",
    "img/vitoria.jpg",
    "img/aindaestouaqui.avif"
  ];

  function gerarFileira(id, repeticoes = 4) {
    const container = document.getElementById(id);
    for (let i = 0; i < repeticoes; i++) {
      for (let poster of posters) {
        const img = document.createElement('img');
        img.src = poster;
        img.alt = "Poster";
        container.appendChild(img);
      }
    }
  }

  gerarFileira("top-row");
  gerarFileira("bottom-row");