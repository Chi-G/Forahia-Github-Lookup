import { BrowserRouter as Router, Route, Routes, useLocation } from 'react-router-dom'
import Navbar from './components/layout/Navbar'
import Footer from './components/layout/Footer'
import Alert from './components/layout/Alert'
import Home from './pages/Home'
import About from './pages/About'
import User from './pages/User'
import NotFound from './pages/NotFound'
import { GithubProvider } from './context/github/GithubContext'
import { AlertProvider } from './context/alert/AlertContext'

function App() {
  return (
    <GithubProvider>
      <AlertProvider>
        <Router>
          <Content />
        </Router>
      </AlertProvider>
    </GithubProvider>
  )
}

function Content() {
  const location = useLocation()

  return (
    <div className='flex flex-col justify-between h-screen'>
      <Navbar />
      <main className='container mx-auto px-3 pb-12'>
        <Routes>
          <Route
            path='/'
            element={
              <>
                <Alert />
                <Home />
              </>
            }
          />
          <Route path='/about' element={<About />} />
          <Route path='/user/:login' element={<User />} />
          <Route path='/notfound' element={<NotFound />} />
          <Route path='*' element={<NotFound />} />
        </Routes>
      </main>

      {/* Only show footer if not on the /about page */}
      {location.pathname !== '/about' && <Footer />}
    </div>
  )
}

export default App