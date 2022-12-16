
function graficobarra(vt,vc,vp,vr)
{
  const grafbar = document.getElementById('bar');
  new Chart(grafbar, {
  type: 'bar',
  data: {
      labels: ['Gestión Total', 'Concretados', 'Pendientes', 'Rechazados'],
      datasets: [{
      label: 'Clientes',
      data: [vt, vc, vp, vr],
      borderWidth: 1,
      borderColor:
          [
              'rgb(54, 162, 235)',
              'rgb(75, 192, 192)',
              'rgb(255, 205, 86)',
              'rgb(255, 99, 132)'
          ],
      backgroundColor:
          [
              'rgba(54, 162, 235, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(255, 99, 132, 0.2)'
          ]
      }]
  },
  options: {
      scales: {
      y: {
          beginAtZero: true
      }
      }
  }
  });
}

function graficopie(vc,vp,vr)
{
  const grafpie = document.getElementById('pie');
  new Chart(grafpie, {
      type: 'pie',
      data: {
          labels: [
              'Concretados',
              'Pendientes',
              'Rechazados'
            ],
            datasets: [{
              label: 'Clientes',
              data: [vc, vp, vr],
              backgroundColor: [
                '#41f1b6',
                '#ffbb55',
                '#fc3747'
              ],
              hoverOffset: 4
            }]
          }
      }  
  );
}

setTimeout(() => {
  let vt = document.getElementById('vt').textContent;
  let vc = document.getElementById('vc').textContent;
  let vp = document.getElementById('vp').textContent;
  let vr = document.getElementById('vr').textContent;

  graficobarra(vt,vc,vp,vr);  
  graficopie(vc,vp,vr);
}, 500);

document.getElementById('fecharequerida').addEventListener("change", function() {
  setTimeout(() => {
    let vt = document.getElementById('vt').textContent;
    let vc = document.getElementById('vc').textContent;
    let vp = document.getElementById('vp').textContent;
    let vr = document.getElementById('vr').textContent;

    graficobarra(vt,vc,vp,vr);  
    graficopie(vc,vp,vr);
  }, 500);
}, false)