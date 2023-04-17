/* alert('sdf');
const cx= document.getElementById('computr_choice');
const ux= document.getElementById('user_choice');
const rx= document.getElementById('result');
const px= document.querySelector('button');
let userChoice;
px.forEach(ps=> ps.addEventListiner('click', (e) =>{
userChoice= e.target.id
ux.innerHTML = userChoice
}) );
 */
let boxsize= 25;
let rows= 20;
let cols= 20;
let board;
let context;
//snake head
let snakeX= 5 * boxsize;
let snakeY= 5 * boxsize;
//food
let foodX ;
let foodY ;
//
velocityX = 0;
velocityY= 0;
// snake body 
snakeBody = [];
//
let gameOver=false;
//
let score =0;

window.onload= function(){
    score_page = document.getElementById('score');
    addScore();
    board =  document.getElementById("board");
    board.height = rows * boxsize;
    board.width = cols * boxsize; 
    context = board.getContext('2d');
    placeFood()
    document.addEventListener('keyup',changeDirection);
    setInterval(update, 1000/10);// 100 milliSeconde
    /* update();  */
 }

 function changeDirection(e){

  if (e.code == "ArrowUp" && velocityY != 1){
    velocityX= 0;
    velocityY= -1;
  }
  else if (e.code == "ArrowDown" && velocityY != -1){
    velocityX= 0;
    velocityY= 1;
  }
  else if (e.code == "ArrowLeft" && velocityX != 1){
    velocityX= -1;
    velocityY= 0;
  }
  else if (e.code == "ArrowRight" && velocityX != -1){
    velocityX= 1;
    velocityY= 0;
  }
 }

 function update(){
    if (gameOver) {
        return ;
    }

    context.fillStyle='black';
    context.fillRect(0, 0, board.height, board.width);
    
    context.fillStyle='red';
    context.fillRect(foodX, foodY, boxsize, boxsize);
    
    if (snakeX == foodX && snakeY == foodY){
        snakeBody.push([foodX, foodY]);
        addScore();
        placeFood();
    }
    
    for (let i = snakeBody.length-1; i > 0; --i){
        snakeBody[i]=snakeBody[i-1];
    }
    if (snakeBody.length){
        snakeBody[0]=[snakeX,snakeY];
    }    

    context.fillStyle='lime';
    snakeX += velocityX*boxsize;
    snakeY += velocityY*boxsize;
    context.fillRect(snakeX, snakeY, boxsize, boxsize);
    for (let i=0; i< snakeBody.length; ++i){
        context.fillRect(snakeBody[i][0], snakeBody[i][1], boxsize, boxsize);
    }

    // game over conditions 
    if (snakeX<0 || snakeX> cols*boxsize || snakeY < 0|| snakeY > rows*boxsize){
        gameOver=true;
        alert("Game Over. Score:"+score);
    }
    for (let i= 0; i< snakeBody.length; ++i){
        if (snakeX == snakeBody[i][0] && snakeY == snakeBody[i][1]){
            gameOver=true;
        alert("Game Over. Score:"+score);
    }}
 }

 function placeFood(){ 
    foodX = Math.floor(Math.random() * cols) * boxsize;
    foodY = Math.floor(Math.random() * rows) * boxsize;
 }

 function addScore(){
    score += 5*snakeBody.length;
    score_page.innerHTML = "Score: "+score;
 }