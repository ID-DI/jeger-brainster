const { forEach } = require("lodash");

function reset()
{
  document.getElementById('btnSubmit').addEventListener('click',function(){
    document.getElementById('emailLabel').classList.add('d-none');
    document.getElementById('chooseFileLabel').classList.add('d-none');
    document.getElementById('chooseFileType').classList.add('d-none');
  });
}

function msg(message) 
{
  $("div.modalBodyResponse").html("<h3 class='modal-title text-center c-text' style='font-family: sans-serif'>"+message+"</h3>");
  $('#modalResponse').modal('show');
  setTimeout(() => {
    $('#modalResponse').modal('hide');
  }, 2000)
}

function msg1(message) 
{
  $("div.modalBodyResponse").html("<h3 class='modal-title text-center c-text' style='font-family: sans-serif'>"+message+"</h3>");
  $('#modalResponse').modal('show');
  setTimeout(() => {
    $('#modalResponse').modal('hide');
  }, 2000)
}

function startLoader()
{
  document.getElementById('loader').classList.remove('d-none');
  document.getElementById('loader').classList.add('d-block');
}

function endLoader()
{
  document.getElementById('loader').classList.remove('d-block');
  document.getElementById('loader').classList.add('d-none');
}

function hide(id) 
{
  document.getElementById(id).classList.add('d-none');
}

function hides(action)
{
  $(action).addClass( "d-none" );
}

function addApproveClass(id, action)
{
  document.getElementById(id).classList.add(action);
}

function changeTitle(title)
{
  document.getElementById('title').innerHTML= title;
}

function cards(element, action, att) {
    for (let i = 0; i < element.length; i++) {
      let divOne = document.createElement('div');
      divOne.setAttribute('id',`${element[i].id}`);
      divOne.innerHTML = `<img class="${action} w-full h-full object-cover cursor-pointer hover:shadow-xl rounded shadow-md border-gray-400 querryImg"
    data-bs-toggle="modal" data-bs-target="#exampleModalLg-${element[i].id}"
    src="${element[i].file_path}" id="${element[i].id}">
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="exampleModalLg-${element[i].id}" tabindex="-1" aria-labelledby="exampleModalLgLabel"
    aria-modal="true" role="dialog">
      <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
          <div
              class="modal-content border-none shadow-xl relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
              <div class="modal-header">
                  <h5 class="modal-title" id="emailSpace">Email: ${element[i].email}</h5>
                  <button type="button"
                      class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                      data-bs-dismiss="modal" aria-label="Close">X</button>
              </div>
              <div class="modal-body relative p-4">
                  <img id="modal-img" src="${element[i].file_path}"
                      class="max-w-[1100px] max-h-[800px] object-cover mx-auto ${action}" />
              </div>
              <div
                  class="modal-footer ${att} flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md" id="modalFooter">
                  <form id="declinedApprovedForm">
                      <input type="hidden" name="_token" value="${csrftoken}">
                      <input type="hidden" value="${element[i].id}" name="declAppId" id="declAppId">
                      <button 
                          class="approve_decline inline-block px-6 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-xl focus:bg-green-600 focus:shadow-xl focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-xl transition duration-150 ease-in-out"
                          data-bs-dismiss="modal" id="declinedApprovedButton" onclick="declinedApproved()">
                          Approve
                      </button>
                  </form>
              </div>
          </div>
      </div>
    </div>
    `;
    document.getElementById('nest').appendChild(divOne);
  }
}


function rewarded(arrOne)
{
  let inputReceiptId = document.getElementById('receiptId');
  let emailRewarded = document.getElementById('emailReward');
  emailRewarded.innerHTML=`Email: ${arrOne[0].email}`;
  inputReceiptId.setAttribute('value', arrOne[0].id);
  
  var select = document.getElementById("reward");
  var options = arrOne[1];

  for(var i = 0; i < options.length; i++) {
      var opt = options[i].type;
      var val = options[i].id;
      var element = document.createElement("option");
      element.textContent = opt;
      element.value = val;
      select.appendChild(element
        );
  }
}







