
function getTotal() {
  item0 = 0;
  item1 = 0;
  item2 = 0;
  item3 = 0;
  item4 = 0;
  item5 = 0;

  if (document.repairs.item_0.checked) {
    item0 = Number(document.getElementById('item_0').value);
  }
  if (document.repairs.item_1.checked) {
    item1 = Number(document.getElementById('item_1').value);
  }
  if (document.repairs.item_2.checked) {
    item2 = Number(document.getElementById('item_2').value);
  }
  if (document.repairs.item_3.checked) {
    item3 = Number(document.getElementById('item_3').value);
  }
  if (document.repairs.item_4.checked) {
    item4 = Number(document.getElementById('item_4').value);
  }
  if (document.repairs.item_5.checked) {
    item5 = Number(document.getElementById('item_5').value);
  }

  var total = 0;
  total = item0 + item1 + item2 + item3 + item4 + item5;
  total = total.toFixed(2);
  document.getElementById('totalCost').innerHTML = "$ " + total;
};

function clearForm() { 
  document.getElementById('totalCost').innerHTML = "$ 00.00";
}

function addToCart() { 

};

