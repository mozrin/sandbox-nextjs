// src/pages/MyProfilePage.tsx

import React from "react";

import Top from "../../../../components/ui/Top/Top";
import Bottom from "../../../../components/ui/Bottom/Bottom";
import Content from "../../../../components/ui/Content/Content";

import styles from "./profile-me.module.css";

const MyProfilePage: React.FC = () => {
  return (
    <div className={styles.pageContainer}>
      <Top />
      <Content>
        <h1>My Profile</h1>
        {/* Profile content */}
      </Content>
      <Bottom />
    </div>
  );
};

export default MyProfilePage;
