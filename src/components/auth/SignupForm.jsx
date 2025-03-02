import React, { useState } from 'react';
import PasswordField from './PasswordField';
import { Link } from 'react-router-dom';

const SignupForm = ({ selectedRole }) => {
  const [formData, setFormData] = useState({
    email: '',
    password: '',
    first_name: '',
    last_name: '',
    phone_number: '',
    date_of_birth: '',
    address: '',
    // Role-specific fields
    student_id: '',
    class_year: '',
    department: '',
    position: '',
    relation_to_student: ''
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle form submission
    console.log({ ...formData, role: selectedRole });
  };

  // Render different fields based on role
  const renderRoleSpecificFields = () => {
    switch (selectedRole) {
      case 'student':
        return (
          <div className="role-fields">
            <h3 className="mb-4">Student Information</h3>
            <div className="mb-3">
              <label htmlFor="student_id" className="form-label">Student ID</label>
              <input
                type="text"
                className="form-control"
                id="student_id"
                name="student_id"
                value={formData.student_id}
                onChange={handleChange}
                required
              />
            </div>
            <div className="mb-3">
              <label htmlFor="class_year" className="form-label">Class Year</label>
              <input
                type="text"
                className="form-control"
                id="class_year"
                name="class_year"
                value={formData.class_year}
                onChange={handleChange}
                required
              />
            </div>
          </div>
        );
      case 'faculty':
        return (
          <div className="role-fields">
            <h3 className="mb-4">Faculty Information</h3>
            <div className="mb-3">
              <label htmlFor="department" className="form-label">Department</label>
              <input
                type="text"
                className="form-control"
                id="department"
                name="department"
                value={formData.department}
                onChange={handleChange}
                required
              />
            </div>
            <div className="mb-3">
              <label htmlFor="position" className="form-label">Position</label>
              <input
                type="text"
                className="form-control"
                id="position"
                name="position"
                value={formData.position}
                onChange={handleChange}
                required
              />
            </div>
          </div>
        );
      case 'guardian':
        return (
          <div className="role-fields">
            <h3 className="mb-4">Guardian Information</h3>
            <div className="mb-3">
              <label htmlFor="relation_to_student" className="form-label">Relation to Student</label>
              <input
                type="text"
                className="form-control"
                id="relation_to_student"
                name="relation_to_student"
                value={formData.relation_to_student}
                onChange={handleChange}
                required
              />
            </div>
          </div>
        );
      default:
        return null;
    }
  };

  return (
    <>
      <h2 className="form-title">Create Account</h2>
      <form onSubmit={handleSubmit}>
        {/* Basic Information */}
        <div className="mb-3">
          <label htmlFor="first_name" className="form-label">First Name</label>
          <input
            type="text"
            className="form-control"
            id="first_name"
            name="first_name"
            value={formData.first_name}
            onChange={handleChange}
            required
          />
        </div>
        <div className="mb-3">
          <label htmlFor="last_name" className="form-label">Last Name</label>
          <input
            type="text"
            className="form-control"
            id="last_name"
            name="last_name"
            value={formData.last_name}
            onChange={handleChange}
            required
          />
        </div>
        <div className="mb-3">
          <label htmlFor="email" className="form-label">Email</label>
          <input
            type="email"
            className="form-control"
            id="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
          />
        </div>
        <PasswordField
          value={formData.password}
          onChange={(e) => handleChange({ target: { name: 'password', value: e.target.value } })}
        />
        <div className="mb-3">
          <label htmlFor="phone_number" className="form-label">Phone Number</label>
          <input
            type="tel"
            className="form-control"
            id="phone_number"
            name="phone_number"
            value={formData.phone_number}
            onChange={handleChange}
          />
        </div>
        <div className="mb-3">
          <label htmlFor="date_of_birth" className="form-label">Date of Birth</label>
          <input
            type="date"
            className="form-control"
            id="date_of_birth"
            name="date_of_birth"
            value={formData.date_of_birth}
            onChange={handleChange}
          />
        </div>
        <div className="mb-3">
          <label htmlFor="address" className="form-label">Address</label>
          <textarea
            className="form-control"
            id="address"
            name="address"
            value={formData.address}
            onChange={handleChange}
            rows="3"
          />
        </div>

        {/* Role-specific fields */}
        {selectedRole && renderRoleSpecificFields()}

        <button type="submit" className="btn btn-login">
          Create Account
        </button>
      </form>
      <p className="signup-text">
        Already have an account? <Link to="/signin">Sign In</Link>
      </p>
    </>
  );
};

export default SignupForm;
