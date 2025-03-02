import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import Signin from './pages/Signin';
import Signup from './pages/Signup';
import AdminDashboard from './pages/admin/AdminDashboard';
import AdminReports from './pages/admin/AdminReports';
import AdminStudents from './pages/admin/AdminStudents';
import AdminSettings from './pages/admin/AdminSettings';
import './App.css';

function App() {
  return (
    <Router>
      <Routes>
        {/* Auth Routes */}
        <Route path="/signin" element={<Signin />} />
        <Route path="/signup" element={<Signup />} />
        
        {/* Admin Routes */}
        <Route path="/admin/dashboard" element={<AdminDashboard />} />
        <Route path="/admin/reports" element={<AdminReports />} />
        <Route path="/admin/students" element={<AdminStudents />} />
        <Route path="/admin/settings" element={<AdminSettings />} />
        
        {/* Default Route */}
        <Route path="/" element={<Navigate to="/signin" replace />} />
        
        {/* Add more routes for students and teachers later */}
      </Routes>
    </Router>
  );
}

export default App;
