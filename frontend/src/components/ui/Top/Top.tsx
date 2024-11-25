"use client"; // Add this directive at the top to mark as a client component

import React from "react";
import { usePathname } from "next/navigation";
import styles from "./Top.module.css";

// Function to convert pathname to page name
const getPageName = (pathname: string | null): string => {
  if (!pathname) {
    return "Dashboard";
  }

  switch (pathname) {
    case "/search":
      return "Search";
    case "/swipe":
      return "Swipe";
    case "/chat":
      return "Chat";
    case "/lists":
      return "Lists";
    case "/my-profile":
      return "My Profile";
    default:
      return "Dashboard";
  }
};

const Top: React.FC = () => {
  const pathname = usePathname();
  const pageName = getPageName(pathname);

  return (
    <div className={styles.topBar}>
      <div className={styles.hamburgerMenu}>☰</div>
      <div className={styles.interfaceName}>{pageName}</div>
    </div>
  );
};

export default Top;
