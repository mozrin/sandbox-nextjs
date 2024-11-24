"use client"; // Add this directive to make it a client component

import React, { useEffect, useState } from "react";
import Content from "~/components/ui/Content/Content";
import styles from "./my-profile.module.css"; // Updated CSS import

interface ProfileData {
  handle: string;
  intro: string;
  bio: string;
  gender: number;
  birthday: string;
  city: string;
  country: string;
  photo1: string;
}

const MyProfilePage: React.FC = () => {
  const [profileData, setProfileData] = useState<ProfileData | null>(null);

  useEffect(() => {
    const fetchProfileData = async () => {
      try {
        const response = await fetch(
          "http://backend.dev.docker/api/my-profile"
        );
        const data = await response.json();
        setProfileData(data);
      } catch (error) {
        console.error("Failed to fetch profile data:", error);
      }
    };

    fetchProfileData();
  }, []);

  if (!profileData) {
    return <Content>Loading...</Content>;
  }

  return (
    <Content>
      <div className={styles.profileContainer}>
        <div className={styles.profileSection}>
          <img
            src={profileData.photo1}
            alt="Profile Picture"
            className={styles.profilePicture}
          />
          <div className={styles.basicInfo}>
            <h1 className={styles.handle}>{profileData.handle}</h1>
            <p className={styles.intro}>{profileData.intro}</p>
            <p className={styles.location}>
              {profileData.city}, {profileData.country}
            </p>
            <p className={styles.birthday}>
              {new Date(profileData.birthday).toLocaleDateString()}
            </p>
          </div>
        </div>
        <div className={styles.detailsSection}>
          <h2>Bio</h2>
          <p>{profileData.bio}</p>
          <div className={styles.actionButtons}>
            <button className={styles.button}>Edit Profile</button>
            <button className={styles.button}>Logout</button>
          </div>
        </div>
      </div>
    </Content>
  );
};

export default MyProfilePage;
