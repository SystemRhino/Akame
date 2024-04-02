@import url('https://fonts.googleapis.com/css2?family=Metal+Mania&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

:root{
    --white: rgba(255, 255, 255);
    --alice-blue: #f8f9fa;
    --carribean-green: #40c9a2;
    --gray: #ededed;
    --black: #090909;
}

*{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	font-family: 'Poppins',sans-serif;
}

html, body{
	height: 100%;
}

h1, h2{
	font-family: "Metal Mania", system-ui;
}

.title-compra{
	color: var(--white);
	font-size: 60px;
}

body{
	background-color: var(--black);
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 1em;
}

main{
	width: 40%;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: flex-start;
	gap: 2em;
}

main .carrinho{
    width: 70%;
    display: flex;
    flex-direction: column;
    gap: 0.5em;
}


.carrinho .item{
    border-left: 0.5px solid #fff;
	width: auto;
	height: auto;
	display: flex;
	justify-content: space-between;
}


.item .image-item{
	color: white;
	width: 6em;
}

.item .image-item img{
	display: block;
	filter: drop-shadow(0px 0px 1px white);
	height: 6em;
}

.item .info-item {
	height: 6em;
	width: 80%;
	padding: 1em;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	color: var(--white);
}

.item .info-item .base-product{
	display: flex;
	justify-content: space-between;	
}

.containerF{
	width: 80%;
	padding: 0 20px;
}

.wrapperF{
	width: 100%;
}

.wrapperF .title{
	height: 90px;
	border-bottom-style:solid;
	border-radius: 5px 5px 0 0;
	color: #fff;
	font-size: 30px;
	font-weight: 600;
	display: flex;
	align-items: center;
	justify-content: center;
}

.wrapperF .formF{
	padding: 30px 25px 25px 25px;
}

.wrapperF .formF .row{
	height: 45px;
	margin-bottom: 15px;
	position: relative;
}

.wrapperF .formF .row input{
	height: 100%;
	width: 100%;
	outline: none;
	padding-left:1rem;
	border-radius: 5px;
	border: 1px solid lightgrey;
	font-size: 16px;
	transition: all 0.3s ease;  
}

select{
	height: 100%;
	width: 100%;
	outline: none;
	padding-left:1rem;
	border-radius: 5px;
	border: 1px solid lightgrey;
	font-size: 16px;
	transition: all 0.3s ease;
}

.formF .row input::placeholder{
  color: #999;
}

.wrapperF .formF .row i{
  position: absolute;
  width: 47px;
  height: 100%;
  color: #fff;
  font-size: 18px;
  background: #16a085;
  border: 1px solid #16a085;
  border-radius: 5px 0 0 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-join{
	padding: 0.8em 1.8em;
    border: 2px solid ;
    position: relative;
    overflow: hidden;
    background-color: transparent;
    text-align: center;
    text-transform: uppercase;
    font-size: 16px;
    transition: .3s;
    z-index: 1;
    font-family: inherit;
    color: var(--white);
    cursor:pointer;
}
   
.btn-join:hover {
	background: var(--white);
	color: #111;
}

span{
	color: pink;
	font-size: 20px;
}

@media only screen and (max-width: 950px) {
	main{
		width: 80%;
	}
}

@media only screen and (max-width: 600px) {
	main{
		width: 100%;
	}

	main .carrinho{
		width: 90%;
	}

	.carrinho .item{
		font-size: 15px;
	}

	.title{
		width: 100%;
		font-size: 35px;
	}

	.containerF{
		padding: 0;
		width: 90%;
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.wrapperF{
		width: 90%;
	}
}
