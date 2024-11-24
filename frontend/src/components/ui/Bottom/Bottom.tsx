"use client"; // Add this directive at the top

import React from "react";
import Link from "next/link";
import { usePathname } from "next/navigation"; // Correct hook for App Router
import styles from "./Bottom.module.css";

const Bottom: React.FC = () => {
  const pathname = usePathname();

  return (
    <div className={styles.navBar}>
      <Link
        href="/search"
        className={`${styles.navItem} ${
          pathname === "/search" ? styles.activeNavItem : ""
        }`}
      >
        Search
      </Link>
      <Link
        href="/swipe"
        className={`${styles.navItem} ${
          pathname === "/swipe" ? styles.activeNavItem : ""
        }`}
      >
        Swipe
      </Link>
      <Link
        href="/chat"
        className={`${styles.navItem} ${
          pathname === "/chat" ? styles.activeNavItem : ""
        }`}
      >
        Chat
      </Link>
      <Link
        href="/lists"
        className={`${styles.navItem} ${
          pathname === "/lists" ? styles.activeNavItem : ""
        }`}
      >
        Lists
      </Link>
      <Link
        href="/my-profile"
        className={`${styles.navItem} ${
          pathname === "/my-profile" ? styles.activeNavItem : ""
        }`}
      >
        My Profile
      </Link>
    </div>
  );
};

export default Bottom;
