var currentpage = window.location.pathname; 

if (currentpage == "/game") {
  
  const FIRSTSCENE = "1"; //First scene to be called - should be the id of first item in CSV
  
  var canvasWidth = jQuery(window).width(),
      canvasHeight = jQuery(window).height(),
      layer = {},
      pageBg = "#C00",
      pageText = "Scene 1",
      pageFont = "sans-serif",
      pageFontSize = "18px ",
      pageTextPos = [],
      pageTextWidth = canvasWidth/2-50,
      pageTextHeight = canvasHeight/2-50,
      pageButtons = [],
      data = [],
      dataDelimiter = "|",
      dataCellDelimiter = ":",
      buttonContainerHeight = 0,
      buttonHeight = 50,
      currentScene;
      
  //Create Canvas and attach to element
  function canvasLayer(location, id) {
    this.element = document.createElement('canvas');

    jQuery(this.element)
     .attr('id', id)
     .text('unsupported browser')
     .width(canvasWidth)
     .height(canvasHeight)
     .appendTo(location);

    this.context = this.element.getContext("2d");
    this.context.canvas.width = canvasWidth;
    this.context.canvas.height = canvasHeight;
  }
  
  //Called by drawScene to put elements on page
  function setStuff(fill, text, textpos) {
    layer.context.fillStyle = fill;
    layer.context.fillRect(0, 0, canvasWidth, canvasHeight);
    layer.context.fillStyle = "#fff";
    layer.context.fillRect(textpos['x'], textpos['y'], pageTextWidth, pageTextHeight);
    layer.context.fillStyle = "#000";
    layer.context.font=pageFontSize + pageFont;
    layer.context.fillText(text, textpos['x']+25, textpos['y']+25, pageTextWidth-25);
    
    if(pageButtons["C"]) {
      buttonContainerHeight += buttonHeight;
      layer.context.fillStyle = "#000";
      layer.context.fillRect(textpos['x'], textpos['y']+pageTextHeight-buttonContainerHeight, pageTextWidth, buttonHeight);
      layer.context.fillStyle = "#fff";
      
      pageButtons["C"].push(textpos['x']);
      pageButtons["C"].push(textpos['y']+pageTextHeight-buttonContainerHeight);
      
      layer.context.fillText(pageButtons["C"][0], textpos['x']+25, textpos['y']+pageTextHeight-buttonContainerHeight+25, pageTextWidth-50);
    }
    if(pageButtons["B"]) {
      buttonContainerHeight += buttonHeight;
      layer.context.fillStyle = "#000";
      layer.context.fillRect(textpos['x'], textpos['y']+pageTextHeight-buttonContainerHeight, pageTextWidth, buttonHeight);
      
      pageButtons["B"].push(textpos['x']);
      pageButtons["B"].push(textpos['y']+pageTextHeight-buttonContainerHeight);
      
      layer.context.fillStyle = "#fff";
      layer.context.fillText(pageButtons["B"][0], textpos['x']+25, textpos['y']+pageTextHeight-buttonContainerHeight+25, pageTextWidth-50);
    }
    if(pageButtons["A"]) {
      buttonContainerHeight += buttonHeight;
      layer.context.fillStyle = "#000";
      layer.context.fillRect(textpos['x'], textpos['y']+pageTextHeight-buttonContainerHeight, pageTextWidth, buttonHeight);
      
      pageButtons["A"].push(textpos['x']);
      pageButtons["A"].push(textpos['y']+pageTextHeight-buttonContainerHeight);
      
      layer.context.fillStyle = "#fff";
      layer.context.fillText(pageButtons["A"][0], textpos['x']+25, textpos['y']+pageTextHeight-buttonContainerHeight+25, pageTextWidth-50);
    }
    
    console.log(pageButtons);
    return;
  }
  
  //Get cursor position on mouse click
  function getCursorPosition() {
    var rect = layer.context.canvas.getBoundingClientRect();
    var x = event.clientX - rect.left;
    var y = event.clientY - rect.top;
    return[x, y];
  }
  
  //If a button was pressed, load the scene that it says
  function mouseClicked(){
    var cursorCoords = getCursorPosition();
    var cursorx = cursorCoords[0];
    var cursory = cursorCoords[1];
    
    if(pageButtons["A"] &&
      cursorx >= pageButtons["A"][2] && cursorx <= pageButtons["A"][2]+pageTextWidth &&
      cursory >= pageButtons["A"][3] && cursory <= pageButtons["A"][3]+buttonHeight) {
        drawScene(pageButtons["A"][1]);
    }
    else if(pageButtons["B"] &&
      cursorx >= pageButtons["B"][2] && cursorx <= pageButtons["B"][2]+pageTextWidth &&
      cursory >= pageButtons["B"][3] && cursory <= pageButtons["B"][3]+buttonHeight) {
        drawScene(pageButtons["B"][1]);
    }
    else if(pageButtons["C"] &&
      cursorx >= pageButtons["C"][2] && cursorx <= pageButtons["C"][2]+pageTextWidth &&
      cursory >= pageButtons["C"][3] && cursory <= pageButtons["C"][3]+buttonHeight) {
        drawScene(pageButtons["C"][1]);
    }
  }

  //Which element is getting the canvas attached to it, and what id will the element get?
  layer = new canvasLayer('body', 'background');
  layer.context.canvas.addEventListener("mousedown", mouseClicked, false);
  
  //Reset stuff on new DrawScene
  function resetScene() {
    temp = [];
    pageButtons = [];
    buttonContainerHeight = 0;
    return;
  }

  //Draw the Page
  var drawScene =function(currScene){
    resetScene();
    currentScene = currScene;
    
    if(data[currentScene]["pageBg"]) { //if Page Background is set for this page, else default is used
      pageBg = data[currentScene]["pageBg"];
    }
    if(data[currentScene]["pageText"]) {  //if Page Text is set for this page, else default is used
      pageText = data[currentScene]["pageText"];
    }
    
    //Are there buttons
    if(data[currentScene]["pageOptionA"] && data[currentScene]["pageOptionALink"]) {  //if Page Text is set for this page, else default is used
      temp["A"] = [];
      temp["A"].push(data[currentScene]["pageOptionA"], data[currentScene]["pageOptionALink"]);
    
      if(data[currentScene]["pageOptionB"] && data[currentScene]["pageOptionBLink"]) {  //if Page Text is set for this page, else default is used
        temp["B"] = [];
        temp["B"].push(data[currentScene]["pageOptionB"], data[currentScene]["pageOptionBLink"]);
    
        if(data[currentScene]["pageOptionC"] && data[currentScene]["pageOptionCLink"]) {  //if Page Text is set for this page, else default is used
          temp["C"] = [];
          temp["C"].push(data[currentScene]["pageOptionC"], data[currentScene]["pageOptionCLink"]);
        }
      }
      pageButtons = temp;
    }
    
    //will put this in CSV
    pageTextPos["x"] = 50;
    pageTextPos["y"] = 60;
    // layer.context.fillText("Scene 1",50, 50);
    setStuff(pageBg, pageText, pageTextPos);
  };
  
  //Get txt file with CSV data
  jQuery.ajax({
    type: "GET",
    url: "templates/gd_aero/js/data.txt",
    dataType: "text",
    success: function(data) {processData(data);}
  });
  
  //Parse data into something useful
  function processData(allText) {
    var allTextLines = allText.split(/\r\n|\n/);
    var headers = allTextLines[0].split('|');
    var lines = [];

    for (var i=1; i<allTextLines.length; i++) {
      data = allTextLines[i].split(dataDelimiter);
      if (data.length == headers.length) {

        var temp = [];
        for (var j=0; j<headers.length; j++) {
          temp[headers[j]] = [];
          temp[headers[j]] = data[j];
        }
        lines[temp[headers[0]]] = [];
        lines[temp[headers[0]]] = temp;
      }
    }
    data = lines;
    console.log(data);
  
    drawScene(FIRSTSCENE); //call first scene
  }
}