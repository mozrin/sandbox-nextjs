// OnlineStatusBox.tsx

import React from "react";
import styles from "./OnlineStatusBox.module.css";

interface OnlineStatusBoxProps {
  onlineMessage: string;
  color: string;
}

const OnlineStatusBox: React.FC<OnlineStatusBoxProps> = ({
  onlineMessage,
  color,
}) => {
  return (
    <div className={styles.onlineStatus} style={{ backgroundColor: color }}>
      {onlineMessage}
    </div>
  );
};

export default OnlineStatusBox;
