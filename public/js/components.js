/**Table most used elements*/

/** table add row*/
function rowBtn(table,attr=""){
  return "<button type='button' title='Add Row' class='btn btn-outline-primary footbtn' onclick='"+table+".appendRow()' "+attr+"><i class='fas fa-plus'></i></button>";
}

function myCheckBox(className,checked="",attr=""){
  return "<input type='checkbox' class='form-check-input "+className+"' "+checked+" "+attr+">";
}

/** className, table*/
function mySel(className,table,attr=""){
  return "<select class='"+className+" form-control form-select custom-select' onmousedown='"+table+".provide(this)' required "+attr+"></select>";
}

/** produces delete icon*/
function deleteIcon(attr=""){
  return "<button type='button' class='btn btn-outline-danger footbtn'><i class='fas fa-trash-alt' title='Delete Row' "+attr+"></i></button>";
}

/** produces submit button*/
function submitBtn(table,attr=""){
  return "<button type='button' class='btn btn-outline-success footbtn' onclick='"+table+".submit()' "+attr+"><i class='fas fa-check' title='Submit'></i></button>";
}

/** type, className, table*/
function myInp(type,className,table=null,value=null,isNode=true,attr=""){
  type = (type===1) ? "text" : (type===2) ? "number" : (type===3) ? "email": "date";
  value = (value===null) ? "" : "value='"+value+"'";
  let node = (isNode)?"this":"";
  table = (table!==null)?"oninput='"+table+".process("+node+")'":"";
  return "<input type='"+type+"' "+value+" class='"+className+" form-control' "+table+" required "+attr+">";
}

/** table del row */
function myDelAttr(table,className=""){
  return {"class":"del "+className,"onclick":table+".deleteRow(this)","style":"vertical-align:middle; text-align: center;"};
}

// class MeterTable {
//   choices = [];
//
//   constructor(obj=undefined,choices=[]) {
//         this.record = {}
//     this.choices = choices;
//   }
//
//   provide(node){
//     let choices = Array.from(this.choices);
//     let nodeClassElements = this.__("."+node.className);
//     let nodeClassLength = nodeClassElements.length;
//     let currentOption = node.value;
//
//     //removing already selected options
//     for (let i = 0; i < nodeClassLength; i++){
//       let position = choices.indexOf(nodeClassElements[i].value);
//       if ((position >= 0)&&(currentOption !== nodeClassElements[i].value)){
//         choices.splice(position, 1);
//       }
//     }
//
//     let count = choices.length;
//     node.innerHTML = "";
//     for (let i = 0; i < count; i++){
//       let selectOption = this._cr("option");
//       selectOption.setAttribute("value", choices[i]);
//       selectOption.innerText = choices[i];
//       if(currentOption===choices[i])
//         selectOption.setAttribute("selected", "selected");
//       node.appendChild(selectOption);
//     }
//   }
//
//   define(node){
//     let ancestor = node.closest('tr');
//     let idValue = node.value + "Meter";
//     let idOpening = node.value + "OpeningMeter";
//     let idClosing = node.value + "ClosingMeter";
//     let idRtt = node.value + "Rtt";
//     let idLitres = node.value + "Litres";
//     let idPrice = node.value + "Price";
//     let idAmount = node.value + "Amount";
//     //product name
//     node.setAttribute("id", idValue);
//     node.setAttribute("name", idValue);
//
//     //getting family
//     let kids = ancestor.children;
//     ancestor.setAttribute("id", node.value);
//     kids[1].firstElementChild.setAttribute("id", idOpening);
//     kids[1].firstElementChild.setAttribute("name", idOpening);
//     kids[2].firstElementChild.setAttribute("id", idClosing);
//     kids[2].firstElementChild.setAttribute("name", idClosing);
//     kids[3].firstElementChild.setAttribute("name", idRtt);
//     kids[3].firstElementChild.setAttribute("id", idRtt);
//     kids[4].setAttribute("id", idLitres);
//     kids[5].firstElementChild.setAttribute("id", idPrice);
//     kids[5].firstElementChild.setAttribute("name", idPrice);
//     kids[6].setAttribute("id", idAmount);
//   }
//
//   update(node){
//     this.record = {};
//     if (node === undefined){
//       return;
//     }
//     let parentNode= node.closest('tr');
//     let kids = parentNode.children;
//     if(kids[0].firstElementChild.getAttribute("id") === null){
//       this.define(kids[0].firstElementChild);
//     }
//     if(kids[0].firstElementChild.getAttribute("id") === "Meter"){
//       this.define(kids[0].firstElementChild);
//       if(kids[0].firstElementChild.getAttribute("id") === "Meter"){
//         alert("Please specify product\nOr delete this row.");
//       }
//     }
//     let idOpening = kids[1].firstElementChild;
//     let idClosing = kids[2].firstElementChild;
//     let idRtt = kids[3].firstElementChild;
//     let idLitres = kids[4];
//     let idPrice = kids[5].firstElementChild;
//     let idAmount = kids[6];
//
//     let closingValue = Number(idClosing.value).toFixed(2) * 100;
//     let openingValue = Number(idOpening.value).toFixed(2) * 100;
//     let rttValue = Number(idRtt.value).toFixed(2) * 100;
//     let diff = ((closingValue - openingValue - rttValue) / 100).toFixed(2);
//     idLitres.innerText = diff.toString();
//     idAmount.innerText = (Number(idPrice.value) * diff).toFixed(0);
//
//     let footCells = this.tfoot.firstElementChild.children;
//     let idTotalLitres = footCells[1];
//     let idTotalAmount = footCells[3];
//
//     //totals
//     let bodyRows = this.tbody.children;
//     let bodyRowLength = bodyRows.length;
//     let totalLitres = 0.00;
//     let totalAmount = 0;
//     for(let i = 0; i < bodyRowLength; i++){
//       let bodyRowKids = bodyRows[i].children;
//       totalLitres += Number(bodyRowKids[4].innerHTML);
//       totalAmount += Number(bodyRowKids[6].innerHTML);
//     }
//
//     totalLitres = totalLitres.toFixed(2);
//     totalAmount = totalAmount.toFixed(0);
//     idTotalLitres.innerHTML = totalLitres.toString();
//     idTotalAmount.innerHTML = totalAmount.toString();
//
//     for (let i = 0; i < bodyRowLength; i++) {
//       let bodyRowKids = bodyRows[i].children;
//       let rowId = bodyRows[i].getAttribute("id");
//       if (this.choices.includes(rowId)){
//         let meterDetails = {};
//         meterDetails[bodyRowKids[1].firstElementChild.getAttribute("id")] = bodyRowKids[1].firstElementChild.value;
//         meterDetails[bodyRowKids[2].firstElementChild.getAttribute("id")] = bodyRowKids[2].firstElementChild.value;
//         meterDetails[bodyRowKids[3].firstElementChild.getAttribute("id")] = bodyRowKids[3].firstElementChild.value;
//         meterDetails[bodyRowKids[5].firstElementChild.getAttribute("id")] = bodyRowKids[5].firstElementChild.value;
//         this.record[rowId] = meterDetails;
//       }
//     }
//   }
//
//   beforeDelete(row){
//     //first Reset all input fields to zero
//     row.children[0].firstElementChild.id = "deletedMeter";
//     row.children[1].firstElementChild.value = "0.00";
//     row.children[2].firstElementChild.value = "0.00";
//     row.children[3].firstElementChild.value = "0.00";
//     row.children[5].firstElementChild.value = "0";
//     this.update(row.children[1].firstElementChild);
//   }
//
//   afterRemove(){
//     this.update(undefined);
//     this.table.hidden = true;
//   }
// }

// class DebtTable{
//   choices = [];
//
//   constructor(obj=undefined,choices=[]) {
//         this.record = {}
//     this.choices = choices;
//   }
//
//   provide(node){
//     let choices = Array.from(this.choices);
//     let nodeClassElements = this.__("."+node.className);
//     let nodeClassLength = nodeClassElements.length;
//     let currentOption = node.value;
//
//     //removing already selected options
//     for (let i = 0; i < nodeClassLength; i++){
//       let position = choices.indexOf(nodeClassElements[i].value);
//       if ((position >= 0)&&(currentOption !== nodeClassElements[i].value)){
//         choices.splice(position, 1);
//       }
//     }
//
//     let count = choices.length;
//     node.innerHTML = "";
//     for (let i = 0; i < count; i++){
//       let selectOption = this._cr("option");
//       selectOption.setAttribute("value", choices[i]);
//       selectOption.innerText = choices[i];
//       if(currentOption===choices[i])
//         selectOption.setAttribute("selected", "selected");
//       node.appendChild(selectOption);
//     }
//   }
//
//   define(node){
//     let ancestor = node.closest('tr');
//     ancestor.setAttribute("id", node.value);
//     let idDebtor = node.value + "Name";
//     let idDescription = node.value + "Description";
//     let idPaid = node.value + "Paid";
//     let idTaken = node.value + "Taken";
//
//     node.setAttribute("id",idDebtor);
//     node.setAttribute("name", idDebtor);
//
//     //getting family
//     let kids = ancestor.children;
//     kids[1].firstElementChild.setAttribute("id", idDescription);
//     kids[1].firstElementChild.setAttribute("name", idDescription);
//     kids[2].firstElementChild.setAttribute("name", idPaid);
//     kids[2].firstElementChild.setAttribute("id", idPaid);
//     kids[3].firstElementChild.setAttribute("name", idTaken);
//     kids[3].firstElementChild.setAttribute("id", idTaken);
//   }
//
//   update(node){
//     this.record = {};
//     if (node === undefined){
//       return;
//     }
//     let parentNode= node.closest('tr');
//     let kids = parentNode.children;
//     if(kids[0].firstElementChild.getAttribute("id") === null){
//       this.define(kids[0].firstElementChild);
//     }
//     if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//       this.define(kids[0].firstElementChild);
//       if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//         alert("Please specify debtor\nOr delete this row.");
//       }
//     }
//
//     let footCells = parentNode.parentElement.parentElement.lastElementChild.firstElementChild.children;
//     let idPaid = footCells[1], idTaken = footCells[2];
//
//     //totals
//     let bodyRows = parentNode.parentElement.children;
//     let bodyRowLength = bodyRows.length;
//     let totalPaid = 0, totalTaken = 0;
//     for(let i = 0; i < bodyRowLength; i++){
//       let bodyRowKids = bodyRows[i].children;
//       totalPaid += Number(bodyRowKids[2].firstElementChild.value);
//       totalTaken += Number(bodyRowKids[3].firstElementChild.value);
//     }
//     totalPaid = totalPaid.toFixed(0);
//     totalTaken = totalTaken.toFixed(0);
//     idPaid.innerHTML = totalPaid.toString();
//     idTaken.innerHTML = totalTaken.toString();
//
//     for (let i = 0; i < bodyRowLength; i++) {
//       let bodyRowKids = bodyRows[i].children;
//       let rowId = bodyRows[i].getAttribute("id");
//       if (this.choices.includes(rowId)){
//         let details = {};
//         details[bodyRowKids[1].firstElementChild.getAttribute("id")] = bodyRowKids[1].firstElementChild.value;
//         details[bodyRowKids[2].firstElementChild.getAttribute("id")] = bodyRowKids[2].firstElementChild.value;
//         details[bodyRowKids[3].firstElementChild.getAttribute("id")] = bodyRowKids[3].firstElementChild.value;
//         this.record[rowId] = details;
//       }
//     }
//
//   }
//
//   beforeDelete(row){
//     //first Reset all input fields to zero
//     row.children[0].firstElementChild.id = "deletedDebtor";
//     row.children[1].firstElementChild.value = null;
//     row.children[2].firstElementChild.value = "0";
//     row.children[3].firstElementChild.value = "0";
//     this.update(row.children[2].firstElementChild);
//   }
//
//   afterRemove(){
//     this.update(undefined);
//     this.table.hidden = true;
//   }
// }
//
// class PrepaidTable{
//   choices = [];
//
//   constructor(obj=undefined,choices=[]) {
//         this.record = {}
//     this.choices = choices;
//   }
//
//   provide(node){
//     let choices = Array.from(this.choices);
//     let nodeClassElements = this.__("."+node.className);
//     let nodeClassLength = nodeClassElements.length;
//     let currentOption = node.value;
//
//     //removing already selected options
//     for (let i = 0; i < nodeClassLength; i++){
//       let position = choices.indexOf(nodeClassElements[i].value);
//       if ((position >= 0)&&(currentOption !== nodeClassElements[i].value)){
//         choices.splice(position, 1);
//       }
//     }
//
//     let count = choices.length;
//     node.innerHTML = "";
//     for (let i = 0; i < count; i++){
//       let selectOption = this._cr("option");
//       selectOption.setAttribute("value", choices[i]);
//       selectOption.innerText = choices[i];
//       if(currentOption===choices[i])
//         selectOption.setAttribute("selected", "selected");
//       node.appendChild(selectOption);
//     }
//   }
//
//   define(node){
//     let ancestor = node.closest('tr');
//     ancestor.setAttribute("id", node.value);
//     let idPrepaid = node.value + "Name";
//     let idDescription = node.value + "Description";
//     let idPaid = node.value + "Paid";
//     let idTaken = node.value + "Taken";
//
//     node.setAttribute("id",idPrepaid);
//     node.setAttribute("name", idPrepaid);
//
//     //getting family
//     let kids = ancestor.children;
//     kids[1].firstElementChild.setAttribute("id", idDescription);
//     kids[1].firstElementChild.setAttribute("name", idDescription);
//     kids[2].firstElementChild.setAttribute("name", idPaid);
//     kids[2].firstElementChild.setAttribute("id", idPaid);
//     kids[3].firstElementChild.setAttribute("name", idTaken);
//     kids[3].firstElementChild.setAttribute("id", idTaken);
//   }
//
//   update(node){
//     this.record = {};
//     if (node === undefined){
//       return;
//     }
//     let parentNode= node.closest('tr');
//     let kids = parentNode.children;
//     if(kids[0].firstElementChild.getAttribute("id") === null){
//       this.define(kids[0].firstElementChild);
//     }
//     if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//       this.define(kids[0].firstElementChild);
//       if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//         alert("Please specify customer\nOr delete this row.");
//       }
//     }
//
//     let footCells = parentNode.parentElement.parentElement.lastElementChild.firstElementChild.children;
//     let idPaid = footCells[1], idTaken = footCells[2];
//
//     //totals
//     let bodyRows = parentNode.parentElement.children;
//     let bodyRowLength = bodyRows.length;
//     let totalPaid = 0, totalTaken = 0;
//     for(let i = 0; i < bodyRowLength; i++){
//       let bodyRowKids = bodyRows[i].children;
//       totalPaid += Number(bodyRowKids[2].firstElementChild.value);
//       totalTaken += Number(bodyRowKids[3].firstElementChild.value);
//     }
//     totalPaid = totalPaid.toFixed(0);
//     totalTaken = totalTaken.toFixed(0);
//     idPaid.innerHTML = totalPaid.toString();
//     idTaken.innerHTML = totalTaken.toString();
//
//     for (let i = 0; i < bodyRowLength; i++) {
//       let bodyRowKids = bodyRows[i].children;
//       let rowId = bodyRows[i].getAttribute("id");
//       if (this.choices.includes(rowId)){
//         let details = {};
//         details[bodyRowKids[1].firstElementChild.getAttribute("id")] = bodyRowKids[1].firstElementChild.value;
//         details[bodyRowKids[2].firstElementChild.getAttribute("id")] = bodyRowKids[2].firstElementChild.value;
//         details[bodyRowKids[3].firstElementChild.getAttribute("id")] = bodyRowKids[3].firstElementChild.value;
//         this.record[rowId] = details;
//       }
//     }
//
//   }
//
//   beforeDelete(row){
//     //first Reset all input fields to zero
//     row.children[0].firstElementChild.id = "deletedPrepaid";
//     row.children[1].firstElementChild.value = null;
//     row.children[2].firstElementChild.value = "0";
//     row.children[3].firstElementChild.value = "0";
//     this.update(row.children[2].firstElementChild);
//   }
//
//   afterRemove(){
//     this.update(undefined);
//     this.table.hidden = true;
//   }
// }

// class ExpenseTable{
//   choices = [];
//
//   constructor(obj=undefined,choices=[]) {
//         this.record = {}
//     this.choices = choices;
//   }
//
//   provide(node){
//     let choices = Array.from(this.choices);
//     let nodeClassElements = this.__("."+node.className);
//     let nodeClassLength = nodeClassElements.length;
//     let currentOption = node.value;
//
//     //removing already selected options
//     for (let i = 0; i < nodeClassLength; i++){
//       let position = choices.indexOf(nodeClassElements[i].value);
//       if ((position >= 0)&&(currentOption !== nodeClassElements[i].value)){
//         choices.splice(position, 1);
//       }
//     }
//
//     let count = choices.length;
//     node.innerHTML = "";
//     for (let i = 0; i < count; i++){
//       let selectOption = this._cr("option");
//       selectOption.setAttribute("value", choices[i]);
//       selectOption.innerText = choices[i];
//       if(currentOption===choices[i])
//         selectOption.setAttribute("selected", "selected");
//       node.appendChild(selectOption);
//     }
//   }
//
//   define(node){
//     let ancestor = node.closest('tr');
//     ancestor.setAttribute("id", node.value);
//     let idExpenseName = node.value + "Name";
//     let idDescription = node.value + "Description";
//     let idAmount = node.value + "Amount";
//
//     node.setAttribute("id",idExpenseName);
//     node.setAttribute("name", idExpenseName);
//
//     //getting family
//     let kids = ancestor.children;
//     kids[1].firstElementChild.setAttribute("id", idDescription);
//     kids[1].firstElementChild.setAttribute("name", idDescription);
//     kids[2].firstElementChild.setAttribute("name", idAmount);
//     kids[2].firstElementChild.setAttribute("id", idAmount);
//   }
//
//   update(node){
//     this.record = {};
//     if (node === undefined){
//       return;
//     }
//     let parentNode= node.closest('tr');
//     let kids = parentNode.children;
//     if(kids[0].firstElementChild.getAttribute("id") === null){
//       this.define(kids[0].firstElementChild);
//     }
//     if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//       this.define(kids[0].firstElementChild);
//       if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//         alert("Please specify expense\nOr delete this row.");
//       }
//     }
//
//     let footCells = parentNode.parentElement.parentElement.lastElementChild.firstElementChild.children;
//     let idETotalAmount = footCells[1];
//
//     //totals
//     let bodyRows = parentNode.parentElement.children;
//     let bodyRowLength = bodyRows.length;
//     let totalAmount = 0;
//     for(let i = 0; i < bodyRowLength; i++){
//       let bodyRowKids = bodyRows[i].children;
//       totalAmount += Number(bodyRowKids[2].firstElementChild.value);
//     }
//     totalAmount = totalAmount.toFixed(0);
//     idETotalAmount.innerHTML = totalAmount.toString();
//
//     for (let i = 0; i < bodyRowLength; i++) {
//       let bodyRowKids = bodyRows[i].children;
//       let rowId = bodyRows[i].getAttribute("id");
//       if (this.choices.includes(rowId)){
//         let details = {};
//         details[bodyRowKids[1].firstElementChild.getAttribute("id")] = bodyRowKids[1].firstElementChild.value;
//         details[bodyRowKids[2].firstElementChild.getAttribute("id")] = bodyRowKids[2].firstElementChild.value;
//         this.record[rowId] = details;
//       }
//     }
//   }
//
//   beforeDelete(row){
//     //first Reset all input fields to zero
//     row.children[0].firstElementChild.id = "deletedExpense";
//     row.children[1].firstElementChild.value = null;
//     row.children[2].firstElementChild.value = "0";
//     this.update(row.children[2].firstElementChild);
//   }
//
//   afterRemove(){
//     this.update(undefined);
//     this.table.hidden = true;
//   }
// }

// class ReceivableTable{
//   choices = [];
//
//   constructor(obj=undefined,choices=[]) {
//         this.record = {}
//     this.choices = choices;
//   }
//
//   provide(node){
//     let choices = Array.from(this.choices);
//     let nodeClassElements = this.__("."+node.className);
//     let nodeClassLength = nodeClassElements.length;
//     let currentOption = node.value;
//
//     //removing already selected options
//     for (let i = 0; i < nodeClassLength; i++){
//       let position = choices.indexOf(nodeClassElements[i].value);
//       if ((position >= 0)&&(currentOption !== nodeClassElements[i].value)){
//         choices.splice(position, 1);
//       }
//     }
//
//     let count = choices.length;
//     node.innerHTML = "";
//     for (let i = 0; i < count; i++){
//       let selectOption = this._cr("option");
//       selectOption.setAttribute("value", choices[i]);
//       selectOption.innerText = choices[i];
//       if(currentOption===choices[i])
//         selectOption.setAttribute("selected", "selected");
//       node.appendChild(selectOption);
//     }
//   }
//
//   define(node){
//     let ancestor = node.closest('tr');
//     ancestor.setAttribute("id", node.value);
//     let idReceivableName = node.value + "Name";
//     let idDescription = node.value + "Description";
//     let idAmount = node.value + "Amount";
//
//     node.setAttribute("id",idReceivableName);
//     node.setAttribute("name", idReceivableName);
//
//     //getting family
//     let kids = ancestor.children;
//     kids[1].firstElementChild.setAttribute("id", idDescription);
//     kids[1].firstElementChild.setAttribute("name", idDescription);
//     kids[2].firstElementChild.setAttribute("name", idAmount);
//     kids[2].firstElementChild.setAttribute("id", idAmount);
//   }
//
//   update(node){
//     this.record = {};
//     if (node === undefined){
//       return;
//     }
//     let parentNode= node.closest('tr');
//     let kids = parentNode.children;
//     if(kids[0].firstElementChild.getAttribute("id") === null){
//       this.define(kids[0].firstElementChild);
//     }
//     if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//       this.define(kids[0].firstElementChild);
//       if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//         alert("Please specify receivable\nOr delete this row.");
//       }
//     }
//
//     let footCells = parentNode.parentElement.parentElement.lastElementChild.firstElementChild.children;
//     let idRTotalAmount = footCells[1];
//
//     //totals
//     let bodyRows = parentNode.parentElement.children;
//     let bodyRowLength = bodyRows.length;
//     let totalAmount = 0;
//     for(let i = 0; i < bodyRowLength; i++){
//       let bodyRowKids = bodyRows[i].children;
//       totalAmount += Number(bodyRowKids[2].firstElementChild.value);
//     }
//     totalAmount = totalAmount.toFixed(0);
//     idRTotalAmount.innerHTML = totalAmount.toString();
//
//     for (let i = 0; i < bodyRowLength; i++) {
//       let bodyRowKids = bodyRows[i].children;
//       let rowId = bodyRows[i].getAttribute("id");
//       if (this.choices.includes(rowId)){
//         let details = {};
//         details[bodyRowKids[1].firstElementChild.getAttribute("id")] = bodyRowKids[1].firstElementChild.value;
//         details[bodyRowKids[2].firstElementChild.getAttribute("id")] = bodyRowKids[2].firstElementChild.value;
//         this.record[rowId] = details;
//       }
//     }
//   }
//
//   beforeDelete(row){
//     //first Reset all input fields to zero
//     row.children[0].firstElementChild.id = "deletedReceivable";
//     row.children[1].firstElementChild.value = null;
//     row.children[2].firstElementChild.value = "0";
//     this.update(row.children[2].firstElementChild);
//   }
//
//   afterRemove(){
//     this.update(undefined);
//     this.table.hidden = true;
//   }
// }

// class TransactionTable{
//   choices = [];
//
//   constructor(obj=undefined,choices=[]) {
//         this.record = {}
//     this.choices = choices;
//   }
//
//   provide(node){
//     let choices = Array.from(this.choices);
//     let nodeClassElements = this.__("."+node.className);
//     let nodeClassLength = nodeClassElements.length;
//     let currentOption = node.value;
//
//     //removing already selected options
//     for (let i = 0; i < nodeClassLength; i++){
//       let position = choices.indexOf(nodeClassElements[i].value);
//       if ((position >= 0)&&(currentOption !== nodeClassElements[i].value)){
//         choices.splice(position, 1);
//       }
//     }
//
//     let count = choices.length;
//     node.innerHTML = "";
//     for (let i = 0; i < count; i++){
//       let selectOption = this._cr("option");
//       selectOption.setAttribute("value", choices[i]);
//       selectOption.innerText = choices[i];
//       if(currentOption===choices[i])
//         selectOption.setAttribute("selected", "selected");
//       node.appendChild(selectOption);
//     }
//   }
//
//   define(node){
//     let ancestor = node.closest('tr');
//     let idType = node.value + "Type";
//     let idOpening = node.value + "Opening";
//     let idClosing = node.value + "Closing";
//     let idChange1 = node.value + "Change1";
//     let idDeposit = node.value + "Deposit";
//     let idWithdraw = node.value + "Withdraw";
//     let idChange2 = node.value + "Change2";
//     //product name
//     node.setAttribute("id", idType);
//     node.setAttribute("name", idType);
//
//     //getting family
//     let kids = ancestor.children;
//     ancestor.setAttribute("id", node.value);
//     kids[1].firstElementChild.setAttribute("id", idOpening);
//     kids[1].firstElementChild.setAttribute("name", idOpening);
//     kids[2].firstElementChild.setAttribute("id", idClosing);
//     kids[2].firstElementChild.setAttribute("name", idClosing);
//     kids[3].setAttribute("id", idChange1);
//     kids[4].firstElementChild.setAttribute("id", idDeposit);
//     kids[4].firstElementChild.setAttribute("name", idDeposit);
//     kids[5].firstElementChild.setAttribute("id", idWithdraw);
//     kids[5].firstElementChild.setAttribute("name", idWithdraw);
//     kids[6].setAttribute("id", idChange2);
//   }
//
//   update(node){
//     this.record = {};
//     if (node === undefined){
//       return;
//     }
//     let parentNode= node.parentElement.parentElement;
//     let kids = parentNode.children;
//     if(kids[0].firstElementChild.getAttribute("id") === null){
//       this.define(kids[0].firstElementChild);
//     }
//     if(kids[0].firstElementChild.getAttribute("id") === "Type"){
//       this.define(kids[0].firstElementChild);
//       if(kids[0].firstElementChild.getAttribute("id") === "Type"){
//         alert("Please specify transaction\nOr delete this row.");
//       }
//     }
//
//     let idOpening = kids[1].firstElementChild;
//     let idClosing = kids[2].firstElementChild;
//     let idChange1 = kids[3];
//     let idDeposit = kids[4].firstElementChild;
//     let idWithdraw = kids[5].firstElementChild;
//     let idChange2 = kids[6];
//
//     let change1 = (Number(idOpening.value) - Number(idClosing.value)).toFixed(0).toString();
//     let change2 = (Number(idDeposit.value) - Number(idWithdraw.value)).toFixed(0).toString()
//
//     if(change1 === change2){
//       idChange1.style.border = "2px solid lightgreen";
//       idChange2.style.border = "2px solid lightgreen";
//       idChange1.style.color = "black";
//       idChange2.style.color = "black";
//     } else{
//       idChange1.style.border = "2px dotted red";
//       idChange2.style.border = "2px dotted red";
//       idChange1.style.color = "red";
//       idChange2.style.color = "red";
//     }
//     idChange1.innerText = change1;
//     idChange2.innerText = change2;
//
//     let footCells = parentNode.parentElement.parentElement.lastElementChild.firstElementChild.children;
//     let idTotalDeposit = footCells[1];
//     let idTotalWithdraw = footCells[2];
//
//     //totals
//     let bodyRows = parentNode.parentElement.children;
//     let bodyRowLength = bodyRows.length;
//     let totalDeposit = 0;
//     let totalWithdraw = 0;
//     for(let i = 0; i < bodyRowLength; i++){
//       let bodyRowKids = bodyRows[i].children;
//       totalDeposit += Number(bodyRowKids[4].firstElementChild.value);
//       totalWithdraw += Number(bodyRowKids[5].firstElementChild.value);
//     }
//     idTotalDeposit.innerHTML = totalDeposit.toFixed(0).toString();
//     idTotalWithdraw.innerHTML = totalWithdraw.toFixed(0).toString();
//
//     for (let i = 0; i < bodyRowLength; i++) {
//       let bodyRowKids = bodyRows[i].children;
//       let rowId = bodyRows[i].getAttribute("id");
//       if (this.choices.includes(rowId)){
//         let details = {};
//         details[bodyRowKids[1].firstElementChild.getAttribute("id")] = bodyRowKids[1].firstElementChild.value;
//         details[bodyRowKids[2].firstElementChild.getAttribute("id")] = bodyRowKids[2].firstElementChild.value;
//         details[bodyRowKids[4].firstElementChild.getAttribute("id")] = bodyRowKids[4].firstElementChild.value;
//         details[bodyRowKids[5].firstElementChild.getAttribute("id")] = bodyRowKids[5].firstElementChild.value;
//         this.record[rowId] = details;
//       }
//     }
//   }
//
//   beforeDelete(row){
//     //first Reset all input fields to zero
//     row.children[0].firstElementChild.id = "deletedTransaction";
//     row.children[1].firstElementChild.value = "0";
//     row.children[2].firstElementChild.value = "0";
//     row.children[4].firstElementChild.value = "0";
//     row.children[5].firstElementChild.value = "0";
//     this.update(row.children[1].firstElementChild);
//   }
//
//   afterRemove(){
//     this.update(undefined);
//     this.table.hidden = true;
//   }
// }

// class ItemTable{
//   choices = {};
//
//   constructor(obj=undefined,choices={}) {
//         this.record = {}
//     this.choices = choices;
//   }
//
//   provide(node){
//     let items = this.choices;
//     let itemValues = [];
//     for (let type in items){
//       for (let x of items[type]){
//         itemValues.push(x);
//       }
//     }
//     let nodeClassElements = document.getElementsByClassName(node.className);
//     let nodeClassLength = nodeClassElements.length;
//     let currentOption = node.value;
//     for (let i = 0; i < nodeClassLength; i++){
//       let position = itemValues.indexOf(nodeClassElements[i].value);
//       if ((position >= 0)&&(node.value !== nodeClassElements[i].value)){
//         itemValues.splice(position, 1);
//       }
//     }
//     let count = itemValues.length;
//     node.innerHTML = "";
//     for (let i = 0; i < count; i++){
//       let selectOption = document.createElement("option");
//       selectOption.setAttribute("value", itemValues[i]);
//       selectOption.innerText = itemValues[i];
//       if(currentOption===itemValues[i])
//         selectOption.setAttribute("selected", "selected");
//       node.append(selectOption);
//     }
//   }
//
//   define(node){
//     let ancestor = node.closest('tr');
//     let items = this.choices;
//     let itemType = null;
//     for (let type in items){
//       for (let x of items[type]){
//         if(x === node.value){
//           itemType = type;
//           break;
//         }
//       }
//     }
//
//     ancestor.setAttribute("id", node.value);
//     let idItemName = node.value + "Name";
//     let idType = node.value + "Type";
//     let idDescription = node.value + "Description";
//     let idQuantity = node.value + "Quantity";
//     let idPrice = node.value + "Price";
//     let idAmount = node.value + "Amount";
//
//     node.setAttribute("id",idItemName);
//     node.setAttribute("name", idItemName);
//
//     //getting family
//     let kids = ancestor.children;
//     kids[1].setAttribute("id", idType);
//     kids[1].innerHTML = itemType;
//     kids[2].firstElementChild.setAttribute("id", idDescription);
//     kids[2].firstElementChild.setAttribute("name", idDescription);
//     kids[3].firstElementChild.setAttribute("name", idQuantity);
//     kids[3].firstElementChild.setAttribute("id", idQuantity);
//     kids[4].firstElementChild.setAttribute("id", idPrice);
//     kids[4].firstElementChild.setAttribute("name", idPrice);
//     kids[5].setAttribute("id", idAmount);
//   }
//
//   update(node){
//     this.record = {};
//     if (node === undefined){
//       return;
//     }
//     let parentNode= node.closest('tr');
//     let kids = parentNode.children;
//     if(kids[0].firstElementChild.getAttribute("id") === null){
//       this.define(kids[0].firstElementChild);
//     }
//     if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//       this.define(kids[0].firstElementChild);
//       if(kids[0].firstElementChild.getAttribute("id") === "Name"){
//         alert("Please specify item\nOr delete this row.");
//       }
//     }
//     let idQuantity = kids[3].firstElementChild;
//     let idPrice = kids[4].firstElementChild;
//     let idAmount = kids[5];
//
//     idAmount.innerText = (Number(idQuantity.value)*Number(idPrice.value)).toFixed(0).toString();
//
//     let footCells = parentNode.parentElement.parentElement.lastElementChild.firstElementChild.children;
//     let idTotalAmount = footCells[1];
//
//     //totals
//     let bodyRows = parentNode.parentElement.children;
//     let bodyRowLength = bodyRows.length;
//     let totalAmount = 0;
//     for(let i = 0; i < bodyRowLength; i++){
//       let bodyRowKids = bodyRows[i].children;
//       totalAmount += Number(bodyRowKids[5].innerHTML);
//     }
//     totalAmount = totalAmount.toFixed(0);
//     idTotalAmount.innerHTML = totalAmount.toString();
//
//     let items = this.choices;
//     let itemValues = [];
//     for (let type in items){
//       for (let x of items[type]){
//         itemValues.push(x);
//       }
//     }
//     for (let i = 0; i < bodyRowLength; i++) {
//       let bodyRowKids = bodyRows[i].children;
//       let rowId = bodyRows[i].getAttribute("id");
//       if (itemValues.includes(rowId)){
//         let itemProperties = {};
//         itemProperties[bodyRowKids[2].firstElementChild.getAttribute("id")] = bodyRowKids[2].firstElementChild.value;
//         itemProperties[bodyRowKids[3].firstElementChild.getAttribute("id")] = bodyRowKids[3].firstElementChild.value;
//         itemProperties[bodyRowKids[4].firstElementChild.getAttribute("id")] = bodyRowKids[4].firstElementChild.value;
//         this.record[rowId] = itemProperties;
//       }
//     }
//   }
//
//   beforeDelete(row){
//     //first Reset all input fields to zero
//     row.children[0].firstElementChild.id = "deletedItem";
//     row.children[2].firstElementChild.value = null;
//     row.children[3].firstElementChild.value = "0";
//     row.children[4].firstElementChild.value = "0";
//     this.update(row.children[2].firstElementChild);
//   }
//
//   afterRemove(){
//     this.update(undefined);
//     this.table.hidden = true;
//   }
// }
