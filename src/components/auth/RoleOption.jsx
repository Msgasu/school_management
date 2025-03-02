import React from 'react';

const RoleOption = ({ value, label, selectedRole, onChange }) => {
  return (
    <label className="role-option">
      <input
        type="radio"
        name="role"
        value={value}
        checked={selectedRole === value}
        onChange={() => onChange(value)}
      />
      <span>{label}</span>
    </label>
  );
};

export default RoleOption;
