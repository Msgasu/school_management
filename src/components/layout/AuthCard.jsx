import React from 'react';
import RoleOption from '../auth/RoleOption';
import SignupForm from '../auth/SignupForm';

const AuthCard = () => {
  const [selectedRole, setSelectedRole] = React.useState('');

  const handleRoleChange = (role) => {
    setSelectedRole(role);
  };

  return (
    <div className="login-card">
      <div className="roles-side">
        <h3>I am a ...</h3>
        <div className="role-selection">
          <RoleOption
            value="student"
            label="Student"
            selectedRole={selectedRole}
            onChange={handleRoleChange}
          />
          <RoleOption
            value="guardian"
            label="Guardian"
            selectedRole={selectedRole}
            onChange={handleRoleChange}
          />
          <RoleOption
            value="faculty"
            label="Faculty"
            selectedRole={selectedRole}
            onChange={handleRoleChange}
          />
        </div>
      </div>
      <div className="form-side">
        <SignupForm selectedRole={selectedRole} />
      </div>
    </div>
  );
};

export default AuthCard;
