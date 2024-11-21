import { FaGithub } from 'react-icons/fa'
import { Link } from 'react-router-dom'
import PropTypes from 'prop-types'

function Navbar({ title = 'Forahia Github Lookup' }) {
  return (
    <nav className='navbar mb-12 shadow-lg bg-neutral text-neutral-content'>
      <div className='container mx-auto flex justify-between items-center'>
        
        {/* Left Section - Logo */}
        <div className='flex-none px-2'>
          <FaGithub className='inline pr-2 text-3xl' />
        </div>

        {/* Center Section - Title */}
        <div className='flex-1 text-center'>
          <Link to='/' className='text-lg font-bold align-middle'>
            {title}
          </Link>
        </div>

        {/* Right Section - Links */}
        <div className='flex-none'>
          <div className='flex justify-end'>
            <Link to='/' className='btn btn-ghost btn-sm rounded-btn'>
              Home
            </Link>
            <Link to='/about' className='btn btn-ghost btn-sm rounded-btn'>
              About
            </Link>
          </div> 
        </div>
      </div>
    </nav>
  )
}

Navbar.propTypes = {
  title: PropTypes.string,
}

export default Navbar