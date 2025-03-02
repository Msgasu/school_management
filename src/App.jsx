import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Signup from './pages/Signup';

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Signup />} />
        {/* Add more routes as needed */}
        {/* <Route path="/signin" element={<Signin />} /> */}
      </Routes>
    </Router>
  );
}

export default App;
