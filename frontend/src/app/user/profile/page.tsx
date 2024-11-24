"use client"; // Add this line at the top to mark as a client component

import React, { useEffect, useState } from "react";
import styles from "./profile.module.css";

interface Profile {
  handle: string;
  gender: number;
  city: string;
  country: string;
  intro: string;
  bio: string;
  photos: string[];
  photo_default: number;
}

const ProfilePage: React.FC = () => {
  const [profile, setProfile] = useState<Profile | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [currentPhotoIndex, setCurrentPhotoIndex] = useState(0);
  const [isMouseOverPhoto, setIsMouseOverPhoto] = useState(false);
  const [onlineMessage, setOnlineMessage] = useState<string>("ONLINE 00:00");
  const [color, setColor] = useState<string>("rgba(0, 128, 0, 0.5)");

  useEffect(() => {
    const fetchProfile = async () => {
      try {
        const response = await fetch(
          "http://backend.dev.docker/api/my-profile"
        );
        if (!response.ok) {
          throw new Error("Failed to fetch profile data");
        }
        const data = await response.json();

        // Transform the data to match the Profile interface
        const transformedProfile: Profile = {
          handle: data.handle,
          gender: data.gender,
          city: data.city,
          country: data.country,
          intro: data.intro,
          bio: data.bio,
          photos: [
            data.photo1,
            data.photo2,
            data.photo3,
            data.photo4,
            data.photo5,
            data.photo6,
            data.photo7,
            data.photo8,
            data.photo9,
            data.photo10,
            data.photo11,
            data.photo12,
            data.photo13,
            data.photo14,
            data.photo15,
            data.photo16,
            data.photo17,
            data.photo18,
            data.photo19,
            data.photo20,
          ].filter((photo) => photo !== null),
          photo_default: data.photo_default,
        };

        setProfile(transformedProfile);
        setCurrentPhotoIndex(transformedProfile.photo_default - 1);
        setLoading(false);
      } catch (error: any) {
        setError(error.message);
        setLoading(false);
      }
    };

    const fetchLastOnline = async () => {
      try {
        const response = await fetch(
          "http://backend.dev.docker/api/user/1/last_online"
        );
        if (!response.ok) {
          throw new Error("Failed to fetch last online data");
        }
        const data = await response.json();

        setOnlineMessage(data.onlineMessage);
        setColor(data.color); // Color is received in RGBA format from API
      } catch (error: any) {
        setError(error.message);
      }
    };

    fetchProfile();
    fetchLastOnline();
  }, []);

  const handlePrevious = () => {
    setCurrentPhotoIndex((prevIndex) =>
      prevIndex === 0
        ? profile
          ? profile.photos.length - 1
          : 0
        : prevIndex - 1
    );
  };

  const handleNext = () => {
    setCurrentPhotoIndex((prevIndex) =>
      profile ? (prevIndex + 1) % profile.photos.length : 0
    );
  };

  const handleWheel = (event: React.WheelEvent<HTMLDivElement>) => {
    if (isMouseOverPhoto) {
      if (event.deltaY < 0) {
        handlePrevious();
      } else {
        handleNext();
      }
    }
  };

  return (
    <div className={styles.profileContainer} onWheel={handleWheel}>
      {loading && <div>Loading...</div>}
      {error && <div>Error: {error}</div>}
      {profile && (
        <>
          <div
            className={styles.photoContainer}
            onMouseEnter={() => setIsMouseOverPhoto(true)}
            onMouseLeave={() => setIsMouseOverPhoto(false)}
          >
            <div
              className={styles.onlineStatus}
              style={{ backgroundColor: color }}
            >
              {onlineMessage}
            </div>
            <img
              src={profile.photos[currentPhotoIndex]} // Use the current photo
              alt="Profile"
              className={styles.profilePhoto}
            />
            <button onClick={handlePrevious} className={styles.leftArrow}>
              &#9664; {/* Left arrow symbol */}
            </button>
            <button onClick={handleNext} className={styles.rightArrow}>
              &#9654; {/* Right arrow symbol */}
            </button>
            <div className={styles.photoIndicators}>
              {profile.photos.map((_, index) => (
                <div
                  key={index}
                  className={`${styles.photoIndicator} ${
                    index === currentPhotoIndex ? styles.active : ""
                  }`}
                ></div>
              ))}
            </div>
          </div>
          <div className={styles.profileInfo}>
            <h1 className={styles.profileHandle}>{profile.handle}</h1>
            <p className={styles.profileDetails}>
              {profile.gender === 1
                ? "Male"
                : profile.gender === 2
                ? "Female"
                : "Other"}{" "}
              / {profile.city}, {profile.country}
            </p>
          </div>
          <div className={styles.profileIntro}>{profile.intro}</div>
          <div className={styles.profileBio}>{profile.bio}</div>
        </>
      )}
    </div>
  );
};

export default ProfilePage;
