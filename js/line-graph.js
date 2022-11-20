let graphTabs = document.getElementsByClassName('stat');
graphTabs = [].slice.call(graphTabs);
let statAmounts = document.getElementsByClassName('stat-amount');
statAmounts = [].slice.call(statAmounts);
let statDiffs = document.getElementsByClassName('stat-diff');
statDiffs = [].slice.call(statDiffs);

let graphTitle = document.getElementById('graph-title');

let xAxis = document.getElementById('x-axis');
let xLabels = [].slice.call(xAxis.children);
let yLabels = document.querySelectorAll('#y-axis text');
yLabels = [].slice.call(yLabels, 0, 5);

let points = document.getElementById('points');
points = [].slice.call(points.children);
let lines = document.getElementById('lines');
lines = [].slice.call(lines.children);

let graphState = {
  activeTab: graphTabs[0],
  data: 'revenue'
};

getGraphData();

graphTabs.forEach(tab => {
  tab.addEventListener('click', highlight);
  tab.addEventListener('click', getGraphData);
});

function highlight(e) {
  let tab = this;

  tab.classList.add('active');
  graphState.activeTab.classList.remove('active');
  graphState.activeTab = tab;

}

function renderStats(data) {

  let statVals = calcStatVals(Object.values(data));

  statAmounts[0].innerHTML = '$' + statVals['revenue'].toLocaleString();//total revenue
  statAmounts[1].innerHTML = statVals['orders'];//total orders
  statAmounts[2].innerHTML = '$' + statVals['average'].toLocaleString();//average per order

}

function calcStatVals(data) {
  let values = {'revenue': 0, 'orders': 0, 'average': 0};

  for(let i in data) {
    values['revenue'] += parseInt(data[i]['revenue']);
    values['orders'] += parseInt(data[i]['total-orders']);
  }
  values['average'] = (values['revenue'] / values['orders']).toFixed(2);

  return values;
}

function renderGraph(data, dataKey) {
  
  let xValues =  Object.keys(data).reverse();
  let yValues =  Object.values(data).map(val => val[dataKey]).reverse();

  let maxScaleVal = renderYValues(yValues);
  let yCoords =     renderPoints( yValues, maxScaleVal);


  renderXValues(xValues);
  renderLines(yCoords);
}

function renderPoints( yValues, maxScaleVal) {

  let coords = getPointYPos(yValues, maxScaleVal);//no need for x until number of x values changes

  points.forEach((pt, ind) => {
    pt.cy.baseVal.valueAsString = coords[ind]; //= coords[ind];
  });

  return coords;
}

function getPointYPos(yValues, maxScalePos) {//i.e. [0,0,3000], 6000 

  let pixelPercentOffset = 3;//93% is min (0), 3% is max position (see svg for numbers)
  let graphHeightPercentage = .9;//93% - 3%

  return yValues.map((val) => {
    let percentOfMax = (val/maxScalePos) * 100;//.5
    let y = (100 - percentOfMax) * graphHeightPercentage;//46.2
    return (y + pixelPercentOffset).toFixed(3) + '%';//46.2%
  });

}

function renderLines(coords) {

  lines.forEach((line, ind) => {
    line.y1.baseVal.valueAsString = coords[ind];
    line.y2.baseVal.valueAsString = coords[1+ind];
  });

}

function dateStrtoDayName(strings) {

  return strings.map((str) => {
    let date = new Date(str.replace(/-/g, '\/'));//for some reason in javascript hyphens in a date string returns one day off where as using slashes corrects it
    return date.toLocaleDateString('en-US', { weekday: 'short' });
  });

}

function renderXValues(dates) {

  let dayNamesArr = dateStrtoDayName(dates);

  xLabels.forEach((ele, ind) => {
    ele.innerHTML = dayNamesArr[ind];
  });

}

function renderYValues(yValues) {

  let yScale = getYScale(yValues);
  
  yLabels.forEach((ele, ind) => {
    ele.innerHTML = yScale[ind];
  });
  
  return Math.max.apply(null, yScale) * 1.2;
}

function getYScale(yValues) {

  let maxVal = Math.max.apply(null, yValues).toString();//value to scale by as a string 
  let scaleUnit = getScaleUnit(maxVal);//i.e. 444 => 100

  return Array.from([5,4,3,2,1], x => x * scaleUnit); //i.e. [500,400,300,200,100]

}

function getScaleUnit(intStr) {

  if(+intStr < 10) { return 2; }

  let lowRange = '5';
  let highRange = '10';

  for(let i = 1; i < intStr.length; i++) {
    lowRange += '0', highRange += '0';
  }

  if(+intStr < +lowRange) {//round down

    if(+intStr <= (+lowRange/5 * 1.2)) {//there is about a fifth more room on the graph
      return (highRange/50);                //so you can go down a decimal place for range
    }
    return (lowRange/5);

  }

  return highRange/5;//else round up
}

function calcCoordinates() {
  
}

function getGraphData(e) {

  let param = this.id || graphState.data;
  
  let xhr = new XMLHttpRequest();
  xhr.open('GET', 'line-graph-json.php?data=' + param, true);
  xhr.onload = function() {

    if(this.status >= 200  && this.status < 400) {
      if(!this.responseText) {return;}

      let data = JSON.parse(this.responseText);

      graphTitle.innerHTML = document.getElementById(param).title;

      renderStats(data);
      renderGraph(data, param);

    } else {
      console.log('Reached the server but there was an error!');
    }

  };

  xhr.onerror = function() {
    console.log('There was an error!');
  }
  
  xhr.send(null);

}