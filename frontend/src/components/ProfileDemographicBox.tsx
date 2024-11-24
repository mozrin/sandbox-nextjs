// ProfileDemographicBox.tsx
import React from "react";
import styles from "./ProfileDemographicBox.module.css";

interface ProfileDemographicBoxProps {
  handle: string;
  gender: number;
  city: string;
  country: string;
}

const ProfileDemographicBox: React.FC<ProfileDemographicBoxProps> = ({
  handle,
  gender,
  city,
  country,
}) => {
  return (
    <div className={styles.profileInfoBox}>
      <div className={styles.profileHandle}>{handle}</div>
      <div className={styles.profileDetails}>
        {gender === 1 ? "Male" : gender === 2 ? "Female" : "Trans"} / {city},{" "}
        {country}
      </div>
    </div>
  );
};

export default ProfileDemographicBox;
