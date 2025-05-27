document.getElementById("crearEquipo").addEventListener("click", () => {
  fetch('/equipo/createTeam', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
    }
  })
    .then(response => response.json())
    .then(data => {
      window.location.assign('/equipo');
    })
    .catch(error => {
      console.error('Error al enviar los datos:', error);
      alert('Error al añadir el miembro.');
    });
});