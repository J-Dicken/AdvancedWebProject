<?php 
	session_start();
	//Redirect if user is logged in already
	if (isset($_SESSION["user"])){
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ohm Electrical: User Registration</title>
	<link rel="stylesheet" href="styles.css">
	<script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
	<script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
	<script src= "https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
</head>
<body>
	<?php require "header.php"; ?>
	<div id="root"></div>

	<script type="text/babel">

	class NameForm extends React.Component {
	  constructor(props) {
	    super(props);
	    this.state = {
	    	name: '',
	    	nameErr: true,
	    	email: '',
	    	emailErr: true,
	    	password: '',
	    	passwordErr: true,
	    	password2: '',
	    	password2Err: true,
	    	phone: '',
	    	phoneErr: true,
	    	registered: false,
	    	exists: false
		};
		

	    this.handleChange = this.handleChange.bind(this);
	    this.handleSubmit = this.handleSubmit.bind(this);
	    this.updateState = this.updateState.bind(this);
	    this.closePopup = this.closePopup.bind(this);
	  }

	  handleChange(event, element) {
	  	//Regular expressions for validation
	    const validName = new RegExp(/^[A-Za-z\s]+$/); //Permits only alphabetical characters or spaces
	    const validEmail = new RegExp(/^[A-Za-z0-9_$%+-]+\.?[A-Za-z0-9_$%+-]*@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/); //first part has to have some characters, followed optionally by a dot and more characters, a single @, then the domain that can feature dots, must finish with a dot followed by at least 2 letters
	    const validPass = new RegExp(/^[A-Za-z0-9_!$£@]{6,}$/); //Password can feature any alphanumeric characters and some special ones, requires minimum length of 6, no need to validate password2 against regex as it is checked against main password, this allows for different error message
	    const validPhone = new RegExp(/^[0-9]{10}$/); //Can only use numbers and has to be 10 digits long

	    //Checks which form element triggered on change event to apply appropriate checks
	  	switch (element){
	  		case 0:
				this.setState({name: event.target.value});
				if (!validName.test(event.target.value)){
					this.setState({nameErr: true});					
				} else{
					this.setState({nameErr: false});
				}
	  			break;
	  		case 1:
	  			this.setState({email: event.target.value});
	  			if (!validEmail.test(event.target.value)){
					this.setState({emailErr: true});					
				} else{
					this.setState({emailErr: false});
				}
	  			break;
	  		case 2:
	  			this.setState({phone: event.target.value});
	  			if (!validPhone.test(event.target.value)){
					this.setState({phoneErr: true});					
				} else{
					this.setState({phoneErr: false});
				}
	  			break;
	  		case 3:
	  			this.setState({password: event.target.value});
	  			if (!validPass.test(event.target.value)){
					this.setState({passwordErr: true});					
				} else{
					this.setState({passwordErr: false});
				}
	  			break;
	  		case 4:
	  			this.setState({password2: event.target.value});
	  			if (this.state.password !== event.target.value){
	  				this.setState({password2Err: true});
	  			} else{
	  				this.setState({password2Err: false});
	  			}
	  			break;
	  	}
	  }

		updateState(){
			this.setState({exists: this.state.exists});	//Simply triggers a re-render as changing the value in the AJAX function didnt trigger one
		}

		closePopup(){
			this.setState({exists: false});
		}
	  handleSubmit(event) {
	    event.preventDefault();
	    if (this.state.phoneErr || this.state.nameErr || this.state.emailErr || this.state.passwordErr || this.state.password2Err){
	    	alert("Fill in form correctly, see hints.");
	    } else{
	    	var httpxml;
	    	var states = this.state; //References to states to change within stateChanged function
			try  {
				// Firefox, Chrome, Opera 8.0+, Safari
				httpxml=new XMLHttpRequest();
			}
			catch (e)  {
				// Internet Explorer
				try    {
					httpxml=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)    {
						try      {
							httpxml=new ActiveXObject("Microsoft.XMLHTTP");
						}
						catch (e)      {
							alert("Your browser does not support AJAX!");
							return false;
						}
				}
			}
			
			function stateChanged(){
				if(httpxml.readyState==4){
					var response = parseInt(httpxml.responseText);
					switch (response){
						case 0:
							states.registered = false;
							states.exists = true;
							break;
						case 1:
							states.registered = true;
							states.exists = false;
							break;
						case 2:
							alert("Invalid email address entered");
							break;
						default:
							alert("Unknown response case: " + response);
							break;
					}
				}

			}

			httpxml.onreadystatechange=stateChanged;
			httpxml.open("POST","addUser.php",false);
			httpxml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			httpxml.send("name="+this.state.name+"&email="+this.state.email+"&phone="+this.state.phone+"&password="+this.state.password);	
		}
		console.log(this.state.exists);
		this.updateState();
	  }

	  render() {
	    return (
	    	<div id="formContainer">
	      <form id="form" onSubmit={this.handleSubmit}>
	      	{this.state.exists && <div class="responseBox"><h3>Email already registered</h3><p onClick={(e) => this.closePopup()}>Close</p></div>}
	      	{this.state.registered && <div class="responseBox"><h3>Registration Successful!</h3><a href="index.php">Continue Shopping</a></div>}
	        <label>
	          Name:
	          <input
	          	className={this.state.nameErr ? "invalid" : "valid"}
	          	name="name"
	          	type="text" 
	          	value={this.state.name} 
	          	onChange={(e) => this.handleChange(e, 0)}
	          	required />
	        </label>
	        {this.state.nameErr && <p class="warning">Name may only contain letters and spaces</p>}	
	        
	        <label>Email Address
			<input 
				className={this.state.emailErr ? "invalid" : "valid"}
				type="email" 
				name="email"
				value={this.state.email} 
				onChange={(e) => this.handleChange(e, 1)}
				required />
			</label>
			{this.state.emailErr && <p class="warning">Must be a valid email address</p>}	

			<label>Mobile
			<input 
				className={this.state.phoneErr ? "invalid" : "valid"}
				type="tel"
				name="phone"
				value={this.state.phone} 
				onChange={(e) => this.handleChange(e, 2)}
				required />
			</label>
			{this.state.phoneErr && <p class="warning">Can only contain numbers and must be 10-digits long</p>}
	              
	        <label>
	        	Password:
				<input
					className={this.state.passwordErr ? "invalid" : "valid"}
					name="password" 
					type="password"
					value={this.state.password}	
					onChange={(e) => this.handleChange(e, 3)}		 
					required />
			</label>
			{this.state.passwordErr && <p class="warning">Password must be a minimum of six letters and can only contain alphanumeric characters or _!$£@</p>}

			<label>
				Re-type Password:
				<input 
					className={this.state.password2Err ? "invalid" : "valid"}
					type="password" 	
					name="password2"
					value={this.state.password2}
					onChange={(e) => this.handleChange(e, 4)}
					required />
			</label>
			{this.state.password2Err && <p class="warning">Passwords must match </p>}			
			<input type="submit" id="subBtn" value="Register" />
			<a href="loginPage.php">Alredy Regsitered? Log In Here </a>
			<a href="index.php">Return Home </a>
	      </form>
	    </div>
	    );
	  }
	}

ReactDOM.render(
  <NameForm />,
  document.getElementById('root')
);


	</script>
</body>
</html>