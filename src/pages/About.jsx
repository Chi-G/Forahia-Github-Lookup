import './About.css';


function About() {
  return (
    <div className="container about-container">
      <div className="imageclass">
        <img src="/logo.png" alt="logo" />
      </div>
      <div className="textclass">
        <h1>
          <u>About this app</u>
        </h1>
        <p>Welcome to Forahia Github Profile Lookup - A powerful tool designed 
          to help you easily explore and view Github profiles. This application 
          enables users to quickly retrieve essential information and insights 
          on any Github user with just a few clicks
        </p>
        <br />
        <p>Version: 1.2.0</p>
        <p>
          Created by{' '}
          <a
            href="https://www.forahia.org.ng"
            target="_blank"
            rel="noopener noreferrer"
          >
            Forahia Enterprise
          </a>
        </p>        
      </div>
    </div>
  )
}

export default About
